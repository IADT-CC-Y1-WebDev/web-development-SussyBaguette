import BankAccount from './classes/BankAccount.js';
import SavingsAccount from './classes/SavingsAccount.js';
import CurrentAccount from './classes/CurrentAccount.js';

let bank = new BankAccount("5738291046", "David Eze", 100.00);
let savings = new SavingsAccount("8301749265", "Bob", 500.00, 0.05);

console.log(`${bank}`);
console.log(`${savings}`);
console.log("=====");

let current = new CurrentAccount("4629173850", "Charlie", 100.00);

(current.deposit(50));
(current.withdraw(20));
(current.deposit(30));

console.log(current.getBalance());
console.log(current.getTransactionCount());
console.log("=====");


let current2 = new CurrentAccount("7192038456", "Diana", 100.00);

(current2.deposit(20));
(current2.withdraw(30));
(current2.deposit(40));
(current2.withdraw(15));
(current2.deposit(25));

console.log("Before Fees" + current2.getBalance());