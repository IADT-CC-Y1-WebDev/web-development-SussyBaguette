import BankAccount from "./BankAccount.js";

class CurrentAccount extends BankAccount {

    constructor(_number, _name, _balance) {
        super(_number, _name, _balance);
        this.transactionCount = 0;

    }

    deposit(amount) {
        return `
        ${this.transactionCount++}
        ${super.deposit(amount)}
        `;
    }

    withdraw(amount) {
        return `
        ${this.transactionCount++}
        ${super.withdraw(amount)}
        `;
    }

    getTransactionCount() {
        return `
        ${this.transactionCount++}
        `;
    }

    // deductFees() {


    // }
}

export default CurrentAccount;


