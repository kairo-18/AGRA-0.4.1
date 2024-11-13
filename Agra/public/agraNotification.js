const channel = Echo.private('private.notif.' + sectionId);

channel.subscribed(() => {
    console.log('subscribed');
}).listen('.agra-notif', (event) => {
    console.log(event);

    const message = event.message;
    const username1 = event.username;

    // Create a new notification item
    const notificationItem = document.createElement('div');
    notificationItem.className = 'px-4 py-2 text-gray-700'; // Add your desired styles

    if(message.includes("Reminder")){
        notificationItem.innerText = `Agra:  ${message}`;
    }else{
        if(username === username1){
            notificationItem.innerText = `Agra: You ${message}`;
        }else{
            notificationItem.innerText = `Agra: One of Your classmate ${message}`;
        }
    }



    // Append the notification item to the notification list
    const notificationList = document.getElementById('notification-list');
    notificationList.appendChild(notificationItem);

    // Show the notification dropdown if it’s hidden
    const dropdown = document.getElementById('notifications-dropdown');
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
    }

    // Automatically hide the notification after a few seconds
    setTimeout(() => {
        // Hide dropdown if there are no more notifications
        if (notificationList.children.length === 0) {
            dropdown.classList.add('hidden');
        }
    }, 5000); // Change the time as needed (5000ms = 5 seconds)
});

document.getElementById('notification-button').addEventListener('click', () => {
    const dropdown = document.getElementById('notifications-dropdown');
    dropdown.classList.toggle('hidden');
});

document.getElementById('read-all-button').addEventListener('click', () => {
    const notificationIds = [];
    const notifications = document.querySelectorAll('#notification-list div[data-notification-id]');

    notifications.forEach(notification => {
        notificationIds.push(notification.getAttribute('data-notification-id'));
    });

    axios.post('/readNotifications', {
        notificationIds: notificationIds,
    })
        .then(function (response) {
            console.log(response);
            window.location.href = "/";
        })
        .catch(function (error) {
            console.log(error);
        });
});
