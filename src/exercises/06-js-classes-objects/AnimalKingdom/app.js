import Cat from './classes/Cat.js';
import Dog from './classes/Dog.js';
import Wolf from './classes/Wolf.js';
import Lion from './classes/Lion.js';

let cat1 = new Cat("Tom", 2);
let dog1 = new Dog("Rover", 2);
let wolf = new Wolf("Wolfie", 4);
let lion = new Lion("Simba", 3);
 
cat1.makeNoise();
cat1.roam();
cat1.sleep();
 
dog1.makeNoise();
dog1.roam();
dog1.sleep();

wolf.makeNoise();
wolf.roam();
wolf.sleep();

lion.makeNoise();
lion.roam();
lion.sleep();