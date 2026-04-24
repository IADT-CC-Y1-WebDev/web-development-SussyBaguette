console.log("Hello World!!");

let user = {
    firstName: "Luke",
    lastName: "Murphy",
    age: "19",
    hobbies: ["Reading", "Sleeping"],
    friends: [
        {
            firstName: "Ryan",
            lastName: "Whealan",
            age: "25",
        },
        {
            firstName: "Ben",
            lastName: "Ben",
            age: "12",
        }
    ],
};

console.log(user.friends[1].lastName);

let donuts = ["Chocolate", "Jam", "Custard"];

donuts.forEach((donut, i) => {
    // console.log((i + 1) + " " + donut);
    console.log(`Option ${i+1}: ${donut}`)
});
