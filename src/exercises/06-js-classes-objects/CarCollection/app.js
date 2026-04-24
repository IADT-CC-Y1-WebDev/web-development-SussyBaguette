// import Car from './classes/Car.js';

let bmw = new Car('BMW', '2 Series', 2014, 'Green', ['HUD', 'Keyless']);
let bmw2 = new Car('BMW', '3 Series', 2021, 'Blue');
let audi = new Car('Audi', '6 Series', 2006, 'Purple');

// console.log(bmw.getMake());
// console.log(audi.getMake());
// console.log(`${bmw}`);

let myCars = [bmw, bmw2, audi];

myCars.forEach((car) => {
    console.log(`${car}`);
    // console.log(car.year);
});