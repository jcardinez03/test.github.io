<?php
    class Employee
    {
        private $name;
        private $civil_status;
        private $position;
        private $employment_status;
        private $regular_hours;
        private $computation;


        public function __construct($name, $civil_status, $position, $employment_status, $regular_hours, $computation)
        {
            $this->name = $name;
            $this->civil_status = $civil_status;
            $this->position = $position;
            $this->employment_status = $employment_status;
            $this->regular_hours = $regular_hours;
            $this->computation = $computation;
        }

        public function daysRendered()
        {
            $days = intval(($this->regular_hours - $this->getOTHours())/8,2);
            return $days;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getCivilStatus()
        {
            return $this->civil_status;
        }

        public function getPosition()
        {
            return $this->position;
        }

        public function getEmploymentStatus()
        {
            return $this->employment_status;
        }

        public function getRegularHours()
        {
            $regular_hours = $this->regular_hours;
            $computation = $this->computation;

            if($computation == "weekly"){
                if($regular_hours > 40){
                    return $regular_hours - $this->getOTHours();
                } else{
                    return $regular_hours;
                }
            }else{
                if($regular_hours > 160){
                    return $regular_hours;
                } else{
                    return $regular_hours;
                }
            }
         
        }

        public function getRegularRate()
        {
            $position = $this->position;
            $employment_status = $this->employment_status;
            
            if($position == "staff" && $employment_status== "contractual")
            {
                return "300/day";
            }
            elseif($position == "staff" && $employment_status== "probationary")
            {
                return "350/day";
            }
            elseif($position == "staff" && $employment_status== "regular")
            {
                return "400/day";
            }
            elseif($position == "admin" && $employment_status== "contractual")
            {
                return "350/day";
            }
            elseif($position == "admin" && $employment_status== "probationary")
            {
                return "400/day";
            }
            elseif($position == "admin" && $employment_status== "regular")
            {
                return "500/day";
            }            
        }

        public function computation()
        {
            return $this->computation;
        }
        
        public function getOTRate()
        {
            $position = $this->position;
            $employment_status = $this->employment_status;
            
            if($position == "staff" && $employment_status== "contractual")
            {
                return "10/hour";
            }
            elseif($position == "staff" && $employment_status== "probationary")
            {
                return "25/hour";
            }
            elseif($position == "staff" && $employment_status== "regular")
            {
                return "30/hour";
            }
            elseif($position == "admin" && $employment_status== "contractual")
            {
                return "15/hour";
            }
            elseif($position == "admin" && $employment_status== "probationary")
            {
                return "30/hour";
            }
            elseif($position == "admin" && $employment_status== "regular")
            {
                return "40/hour";
            }     
            
        }

        public function computeGrossIncome()
        {
            return ($this->computeRegularPay());
        }

        public function computeNetIncome()
        {
            $gross = $this->computeGrossIncome();
            $tax = $this->computeTax($gross);
            $healthCare = $this->getHealthCare(); 
            return ($gross - ($tax + $healthCare));
        }
        public function getOTHours()
        {
            $regular_hours = $this->getRegularHours();

                if($this->computation == "weekly"){
                    if ($regular_hours >= 40){
                        $ot_hours = $this->regular_hours - 40;
                        return $ot_hours;
                    } else{
                        return 0;
                    }
                } elseif($this->computation == "monthly"){
                    if ($regular_hours >= 160){
                        $ot_hours = $this->regular_hours - 160;
                        return $ot_hours;
                    }else{
                        return 0;
                    }
                }
        }
        public function computeRegularPay()
        {
            $position = $this->position;
            $employment_status = $this->employment_status;
            $regular_hours = $this->regular_hours;
            $computation = $this->computation();
            
            if($position == "staff" && $employment_status == "contractual")
            {
                if($regular_hours >= 40){    
                    if ($computation == "weekly"){
                        $ot_hours = $regular_hours - 40;
                        return ((300/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    } elseif($computation == "monthly") {
                        $ot_hours = $regular_hours - 160;
                        return ((300/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    }
                } else{
                    return ((300/8) * $regular_hours);

                }
            }
            elseif($position == "staff" && $employment_status== "probationary")
            {
                if($regular_hours >= 40){    
                    if ($computation == "weekly"){
                        $ot_hours = $regular_hours - 40;
                        return ((350/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    } elseif($computation == "monthly") {
                        $ot_hours = $regular_hours - 160;
                        return ((350/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    }
                } else{
                    return ((350/8) * $regular_hours);
                }
            }
            elseif($position == "staff" && $employment_status== "regular")
            {
                if($regular_hours >= 40){    
                    if ($computation == "weekly"){
                        $ot_hours = $regular_hours - 40;
                        return ((400/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    } elseif($computation == "monthly") {
                        $ot_hours = $regular_hours - 160;
                        return ((400/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    }
                } else{
                    return ((400/8) * $regular_hours);

                }
            }
            elseif($position == "admin" && $employment_status== "contractual")
            {
                if($regular_hours >= 40){    
                    if ($computation == "weekly"){
                        $ot_hours = $regular_hours - 40;
                        return ((350/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    } elseif($computation == "monthly") {
                        $ot_hours = $regular_hours - 160;
                        return ((350/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    }
                } else{
                    return ((350/8) * $regular_hours);
                }
            }
            elseif($position == "admin" && $employment_status== "probationary")
            {
                if($regular_hours >= 40){    
                    if ($computation == "weekly"){
                        $ot_hours = $regular_hours - 40;
                        return ((400/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    } elseif($computation == "monthly") {
                        $ot_hours = $regular_hours - 160;
                        return ((400/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    }
                } else{
                    return ((400/8) * $regular_hours);
                }
            }
            elseif($position == "admin" && $employment_status== "regular")
            {
                if($regular_hours >= 40){    
                    if ($computation == "weekly"){
                        $ot_hours = $regular_hours - 40;
                        return ((500/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    } elseif($computation == "monthly") {
                        $ot_hours = $regular_hours - 160;
                        return ((500/8) * ($regular_hours - $ot_hours)) + ($ot_hours * $this->computeOTPay());
                    }
                } else{
                    return ((500/8) * $regular_hours);
                }
            }
        }
        
        public function computeOTPay()
        {
            $position = $this->position;
            $employment_status = $this->employment_status;
            
            if($position == "staff" && $employment_status== "contractual")
            {
                return 10;
            }
            elseif($position == "staff" && $employment_status== "probationary")
            {
                return 25;
            }
            elseif($position == "staff" && $employment_status== "regular")
            {
                return 30;
            }
            elseif($position == "admin" && $employment_status== "contractual")
            {
                return 15;
            }
            elseif($position == "admin" && $employment_status== "probationary")
            {
                return 30;
            }
            elseif($position == "admin" && $employment_status== "regular")
            {
                return 40;
            }            
        }

        public function computeTax()
        {
            $grossIncome = $this->computeGrossIncome();

            if($this->civil_status == "single" && $grossIncome <= 1000 || $this->civil_status == "married" && $grossIncome <= 1500)
            {
                return 0;
            }
            elseif($this->civil_status == "single" && $grossIncome > 1000) 
            {   
					return ($grossIncome * 0.05);
            }
            elseif($this->civil_status == "married" && $grossIncome > 1500)
            {
                return ($grossIncome * 0.03);
            }
        }

        public function getHealthCare()
        {
            if($this->civil_status == "single")
            {
                return 200;
            }
            elseif($this->civil_status == "married")
            {
                return 75;
            }
        }
    }
?>