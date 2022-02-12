<?php

namespace App;

use App\Scopes\CompanyScope;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    public function getNameAttribute($value) {
        return $this->{'name_'.app()->getLocale()};
    }

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope());
    }

    public function approvalstaff(){
        return $this->hasOne(Approvalstaff::class);
    }

    public function requests()
    {
        return $this->hasMany(Myrequest::class);
    }

    public function requests_employees()
    {
        $items = $this->hasMany(Myrequest::class, 'show_employee');
        return $items->where('status', 'pending');
    }
    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
    

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    

    public static function search_from_job_number($job_number){
        $em = Employee::query()
        ->where('job_number', $job_number)
        ->orWhere('name_ar', 'LIKE', "%{$job_number}%")
        ->orWhere('name_en', 'LIKE', "%{$job_number}%")->first();
        if($em){
            $em->name = $em->name;
        }
        return $em;
    }

    public static function Hourly_salary_in_basic(Employee $em, $date_start,$date_end){
        
        $salary = $em->salary;

        if($em->company->month_calculator == "30days"){
            return ($salary / 240);
        }

        $days = Carbon::parse($date_end)->daysInMonth;
        $hours = $days*8;
        
        return ($salary / $hours);
    }

    public static function Hourly_salary_in_total(Employee $em, $date_start,$date_end){
        
        $salary = ($em->salary+$em->payroll_hra()+$em->payroll_trans()+$em->payroll_allowances());

        if($em->company->month_calculator == "30days"){
            return ($salary / 240);
        }

        $days = Carbon::parse($date_end)->daysInMonth;
        $hours = $days*8;
        
        return ($salary / $hours);
    }

    public function deductions(){
        return $this->hasMany(Deduction::class);
    }

    public function allowances(){
        return $this->hasMany(Allowance::class);
    }


    public function deduction2(){
        return $this->deductions()->where('type','deduction2');
    }

    public function overtimes(){
        return $this->deductions()->where('type','overtime');
    }

    public function payroll($date){
        return $date;
    }


    public function payroll_hra(){

        if($this->hra_value != ''){
            return $this->hra_value;
        }
        
        if($this->hra_percentage != ''){
            return percentage($this->hra_percentage, $this->salary);
        }
        return 0.00;
    }

    public function payroll_trans(){

        if($this->trans_value != ''){
            return $this->trans_value;
        }
        
        if($this->trans_percentage != ''){
            return percentage($this->trans_percentage, $this->salary);
        }
        return 0.00;
    }

    public function payroll_allowances(){

        $allowances = $this->allowances;
        $num = 0;
        foreach($allowances as $allowance){
            if($allowance->value != ''){
                $num += $allowance->value;
            }
            
            if($allowance->percentage != ''){
                $num += percentage($allowance->percentage, $this->salary);
            }
        }
        return $num;
    }

    public function payroll_gosi(){
        if($this->nationality_id == 1){
            return (percentage(10, ($this->salary+$this->payroll_hra()))) * -1;
        }
        return 0.00;
    }

    
    

    public function payroll_absence(){

        $allowances = $this->deduction2;
        $num = 0;
        foreach($allowances as $allowance){
            if($allowance->value != ''){
                $num += $allowance->value;
            }
        }
        return $num * -1;

    }

    // كل الخصومات
    public function total_deductions(){
        return ($this->payroll_gosi()+$this->payroll_absence());
    }

    public function payroll_net_salary(){
        return ($this->salary+$this->payroll_hra()+$this->payroll_trans()+$this->payroll_allowances()+$this->total_deductions());
    }

        public function payroll_net_salary_in_emp(){
            return ($this->salary+$this->payroll_hra()+$this->payroll_trans()+$this->payroll_allowances()+$this->payroll_gosi());
    }

    public function current_balance(){

        $myrequests = Myrequest::where([
            ['type','leave'],
            ['employee_id',$this->id],
            ['status','success'],
        ])->get();
        
        $number_of_vacation_days = 0;
        foreach($myrequests as $myrequest){
            $number_of_vacation_days += $myrequest->myvacation->the_number_of_days();
        }

        if($this->available_balance == NULL){
            $date = Carbon::parse($this->contract_start_date);
            $now  = Carbon::now();
            $diff = $date->diffInDays($now);
            return ($diff * ($this->annual_balance / 365)) - $number_of_vacation_days;
        }

        $date = Carbon::parse($this->created_at);
        $now  = Carbon::now();
        $diff = $date->diffInDays($now);
        return (($diff * ($this->annual_balance / 365)) + $this->available_balance)  - $number_of_vacation_days;

    }


}
