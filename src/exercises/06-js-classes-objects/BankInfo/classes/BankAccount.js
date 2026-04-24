class BankAccount {

    constructor(_number, _name, _balance) {
        this.number = _number;
        this.name = _name;
        this.balance = _balance;
    }

    toString() {
        return `
        Account: ${this.number}
        Name: ${this.name}
        Balance: €${this.balance}
        `;
    }

    getBalance(){
        return `
        Balance: €${this.balance}
        `;
    }

    deposit(amount) {
        return `
        Deposit: €${this.balance += amount}
        `;
    }
    
    withdraw(amount) {
        return `
        withdraw: €${this.balance -= amount}
        `;
    }

    // withdraw() {
    //     $this->transactionCount++;      // Add our own behaviour
    //     parent::withdraw($amount);       // Then call parent's withdraw
    // }
}

export default BankAccount;