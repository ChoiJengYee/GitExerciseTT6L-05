<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Event Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: cornflowerblue;
            padding: 20px;
        }
        .container {
            display: flex;
            width: 100%;
            max-width: 900px;
        }
        .wrapper {
            width: 450px;
            background: white;
            border-radius: 10px;
            margin-right: 20px;
            flex-shrink: 0;
        }
        .wrapper header {
            display: flex;
            align-items: center;
            padding: 25px 30px 10px;
            justify-content: space-between;
        }
        header .current-date {
            font-size: 1.45rem;
            font-weight: 500;
        }
        header .icons span {
            height: 38px;
            width: 38px;
            color: gray;
            font-size: 1.9rem;
            margin: 0 1px;
            cursor: pointer;
            text-align: center;
            line-height: 38px;
            border-radius: 50%;
            background: white;
        }
        header .icons span:hover {
            background: #f0f0f0;
        }
        header .icons span:last-child {
            margin-right: -10px;
        }
        .calendar {
            padding: 20px;
        }
        .calendar ul {
            display: flex;
            list-style: none;
            flex-wrap: wrap;
            text-align: center;
        }
        .calendar .days {
            margin-bottom: 20px;
            color: black;
        }
        .calendar .days li {
            z-index: 1;
            cursor: pointer;
            margin-top: 30px;
        }
        .days li.inactive {
            color: rgb(159, 155, 149);
        }
        .days li.active {
            color: red;
            font-weight: bold;
        }
        .days li.event {
            color: white;
        }
        .calendar .weeks li {
            font-weight: 500;
        }
        .calendar ul li {
            position: relative;
            width: calc(100% / 7);
        }
        .calendar .days li::before {
            position: absolute;
            content: "";
            height: 40px;
            width: 40px;
            top: 50%;
            left: 50%;
            z-index: -1;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            background: white;
        }
        .days li:hover::before {
            background: rgb(250, 215, 249);
        }
        .days li.active::before {
            background: white;
        }
        .days li.event::before {
            background: yellow;
        }
        .days li.active.event::before {
            background: yellow;
        }
        .days li.active.event {
            color: red;
            font-weight: bold;
        }
        .event-details {
            width: 450px;
            background: white;
            border-radius: 10px;
            padding: 20px;
        }
        .event-details h2 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="wrapper">
        <header>
            <p class="current-date"></p>
            <div class="icons">
                <span id="prev" class="material-symbols-rounded">chevron_left</span>
                <span id="next" class="material-symbols-rounded">chevron_right</span>
            </div>
        </header>
        <div class="calendar">
            <ul class="weeks">
                <li>Sun</li>
                <li>Mon</li>
                <li>Tue</li>
                <li>Wed</li>
                <li>Thu</li>
                <li>Fri</li>
                <li>Sat</li>
            </ul>
            <ul class="days"></ul>
        </div>
    </div>
    <div class="event-details">
        <h2>Event Details</h2>
        <p id="event-info">No event selected</p>
    </div>
</div>
<script>
    const currentDate = document.querySelector(".current-date"),
        daysTag = document.querySelector(".days"),
        prevNextIcon = document.querySelectorAll(".icons span"),
        eventInfo = document.getElementById("event-info");

    let date = new Date(),
        currYear = date.getFullYear(),
        currMonth = date.getMonth();

    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

<<<<<<< HEAD
    let events = {};

    const fetchEvents = async () => {
        try {
            const response = await fetch('get_event.php');
            events = await response.json();
            renderCalendar();
        } catch (error) {
            console.error('Error fetching events:', error);
=======
    const events = {
        "6-14": {
            description: "Suffocate Stage Show",
            url: "event (1).html"
        },
        "6-7": {
            description: "Mini concert",
            url: "event (2).html"
>>>>>>> a59267eb3ba55d6155fa1aa23b98b870a3810cc9
        }
    };

    const renderCalendar = () => {
        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
            lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
            lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
            lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
        let liTag = "";

        for (let i = firstDayofMonth; i > 0; i--) {
            liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
        }

        for (let i = 1; i <= lastDateofMonth; i++) {
            let isToday = i === date.getDate() && currMonth === new Date().getMonth()
                && currYear === new Date().getFullYear() ? "active" : "";
            let hasEvent = events[`${currMonth + 1}-${i}`] ? "event" : "";
            liTag += `<li class="${isToday} ${hasEvent}" data-date="${currMonth + 1}-${i}">${i}</li>`;
        }

        for (let i = lastDayofMonth; i < 6; i++) {
            liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
        }

        currentDate.innerText = `${months[currMonth]} ${currYear}`;
        daysTag.innerHTML = liTag;

        document.querySelectorAll(".days li").forEach(day => {
            day.addEventListener("click", () => {
                const date = day.getAttribute("data-date");
                if (events[date]) {
<<<<<<< HEAD
                    const event = events[date];
                    eventInfo.innerHTML = `
                        <p><strong>Start Time:</strong> ${event.start_time || 'N/A'}</p>
                        <p><strong>End Time:</strong> ${event.end_time || 'N/A'}</p>
                        <p><strong>Location:</strong> ${event.location || 'N/A'}</p>
                        <p><strong>Description:</strong> ${event.description}</p>
                        <p><a href="${event.url}" target="_blank">Register Here</a></p>
                        ${event.images ? `<img src="${event.images}" alt="Event Image" style="max-width:100%; border-radius: 10px;">` : ''}
                    `;
=======
                    eventInfo.innerText = events[date].description;
                    window.location.href = events[date].url;
>>>>>>> a59267eb3ba55d6155fa1aa23b98b870a3810cc9
                } else {
                    eventInfo.innerText = "No event for this day.";
                }
            });
        });

        scheduleReminder();
    };

    const scheduleReminder = () => {
        const now = new Date();
        const todayDateString = `${now.getMonth() + 1}-${now.getDate()}`;

        if (events[todayDateString]) {
            const nextMorning = new Date();
            nextMorning.setHours(9, 0, 0, 0); // Set the reminder time to 9:00 AM

            if (nextMorning > now) {
                const timeToReminder = nextMorning - now;
                setTimeout(() => {
                    alert(`Reminder: ${events[todayDateString].description}`);
                }, timeToReminder);
            }
        }
    };

<<<<<<< HEAD
=======
    renderCalendar();

>>>>>>> a59267eb3ba55d6155fa1aa23b98b870a3810cc9
    prevNextIcon.forEach(icon => {
        icon.addEventListener("click", () => {
            currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

            if (currMonth < 0 || currMonth > 11) {
                date = new Date(currYear, currMonth);
                currYear = date.getFullYear();
                currMonth = date.getMonth();
            } else {
                date = new Date();
            }

<<<<<<< HEAD
            fetchEvents();
        });
    });

    fetchEvents();
</script>
</body>
</html>



=======
            renderCalendar();
        });
    });
</script>
</body>
</html>
>>>>>>> a59267eb3ba55d6155fa1aa23b98b870a3810cc9
