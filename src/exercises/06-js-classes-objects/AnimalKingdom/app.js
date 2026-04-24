import Cat from './classes/Cat.js';
import Dog from './classes/Dog.js';
import Wolf from './classes/Wolf.js';
import Lion from './classes/Lion.js';


let cat = new Cat('David Eze', 1);
let dog = new Dog('Jerry', 2);
let wolf = new Wolf('Razor', 5);
let lion = new Lion('Varka', 8);

let animals = [cat, dog, lion, wolf];

animals.forEach((animal) => {
    animal.makeNoise();
    animal.roam();
    animal.sleep();

    console.log("======");
});
