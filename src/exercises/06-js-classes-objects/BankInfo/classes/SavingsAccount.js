import BankAccount from "./BankAccount.js";

class SavingsAccount extends BankAccount {

    constructor(_number, _name, _balance, _rate) {
        super(_number, _name, _balance);
        this.interestRate = _rate;

        // if(typeof _rate === 'undefined' && _rate === 0 < 0){
        //     this.interestRate = _rate;
        // }
        // else {
        //     this.interestRate = ['2'];
        // }
        
    }

    // Override __toString() to include interest rate
    toString() {
        return `
        Account: ${this.number}
        Name: ${this.name}
        Balance: €${this.balance}
        Savings: €${this.interestRate * 100}
        `;
    }
}

export default SavingsAccount;
