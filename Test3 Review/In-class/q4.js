function convertDistanceToTime(distance) {
  if (distance < 0) {
    alert("Distance cannot be negative");
    return;
  }

  const walkingSpeed = 3; // miles per hour
  const timeInHours = distance / walkingSpeed;
  const timeInMinutes = timeInHours * 60;

  return timeInMinutes;
}

const distance = prompt("Enter the distance in miles:");
const time = convertDistanceToTime(distance);

document.write(`Distance: ${distance} miles`);
document.write(`Time: ${time} minutes`);

//! -------------------------------------------------------------

const convertDistanceToTime_2 = (distance) => {
  if (distance < 0) {
    alert("Distance cannot be negative");
    return;
  }

  const walkingSpeed = 20; // minutes per mile
  const timeInMinutes = distance * walkingSpeed;

  return timeInMinutes;
};

let distance_2 = prompt("Enter the distance in miles:");
const time_2 = convertDistanceToTime_2(distance_2);

document.write(`Distance: ${distance_2} miles`);
document.write(`Time: ${time_2} minutes`);
