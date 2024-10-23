// sample car data
const cars = [
	{ make: "Toyota", model: "Corolla", year: 2015 },
	{ make: "Honda", model: "Civic", year: 2018 },
	{ make: "Ford", model: "Focus", year: 2012 },
	{ make: "Toyota", model: "Camry", year: 2010 },
	{ make: "Honda", model: "Accord", year: 2015 },
];

// function to render car list
function renderCarList(cars) {
	const carList = document.getElementById("car-list");
	carList.innerHTML = "";
	cars.forEach((car) => {
		const li = document.createElement("li");
		li.textContent = `${car.year} ${car.make} ${car.model}`;
		carList.appendChild(li);
	});
}

// function to filter cars
function filterCars() {
	const makeSelect = document.getElementById("make");
	const modelSelect = document.getElementById("model");
	const filteredCars = cars.filter((car) => {
		if (makeSelect.value && car.make !== makeSelect.value) return false;
		if (modelSelect.value && car.model !== modelSelect.value) return false;
		return true;
	});
	renderCarList(filteredCars);
}

// add event listener to filter button
document.getElementById("filter-btn").addEventListener("click", filterCars);

// render initial car list
renderCarList(cars);