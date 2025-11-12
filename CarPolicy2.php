<?php
class CarPolicy {
    private $policyNumber;
    private $yearlyPremium;
    private $dateOfLastClaim;

    public function __construct($policyNumber, $yearlyPremium) {
        $this->policyNumber = $policyNumber;
        $this->yearlyPremium = $yearlyPremium;
    }

    public function setDateOfLastClaim($dateOfLastClaim) {
        $this->dateOfLastClaim = $dateOfLastClaim;
    }

    public function getTotalYearsNoClaims() {
        $currentDate = new DateTime();
        $lastDate = new DateTime($this->dateOfLastClaim);
        $internal = $currentDate->diff($lastDate);
        return $internal->format("%y");
    }

    public function getDiscount() {
        $discount =0;
        $tync = $this->getTotalYearsNoClaims();
        if ($tync>=3 && $tync<=5) {
            $discount =10;
        }
        elseif ($tync>5) {
            $discount= 15;
        }
        return $discount;
    }
    public function getDiscountedPremium() {
        $yearlyPremium = $this->yearlyPremium;
        $discount = ($yearlyPremium/100)*$this->getDiscount();
        return $yearlyPremium-$discount;
    }
    public function __toString() {
        return "PN: " . $this->policyNumber;
    }
}
?>