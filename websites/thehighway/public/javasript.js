document.addEventListener('DOMContentLoaded', function(){
    const adminClassList = document.getElementsByTagName('div')[7].classList;
    const homeClassList = document.body.classList;
    const registerClassList = document.body.classList;
    const dropElement = document.getElementById('drop1');
    const kitchenClassList = document.getElementsByTagName('h3')[0].classList;

    if (dropElement) {
        const checkoutClassList = dropElement.classList;
        if (checkoutClassList.contains("checkout-page")) {
            initCheckoutPage();
        }
    } 

    if (adminClassList.contains("admin-page")) {
        initAdminPage();
    }

    if (registerClassList.contains("register")) {
        initRegisterPage();
    }

    if (homeClassList.contains("home-page")) {
        initHomePage();
    }

    if (kitchenClassList.contains("kitchen")) {
        initKitchenPage();
    }
    
});

// Global functions for showing/hiding descriptions
function showDescription(event, description) {
    let descBox = document.getElementById("floating-description");
    let descContent = document.getElementById("desc-content");

    descContent.textContent = description;

    // Position the description box near the clicked icon
    descBox.style.left = event.pageX + "px";
    descBox.style.top = event.pageY + "px";

    // Show the description box
    descBox.style.display = "block";
}

function hideDescription() {
    document.getElementById("floating-description").style.display = "none";
}

// Initialize home page functionality
function initHomePage() {
    const popupOverlay = document.getElementById('popupOverlay');
    const popup = document.getElementById('popup');
    const closePopup = document.getElementById('closePopup');
    const cartIcon = document.getElementById('cart');
    const nav = document.getElementById("nav");
    const navbtn = document.getElementById("navbtn");
    const openCreateMealBtn = document.getElementById('create-meal');
    const createMealSection = document.getElementById('create-meal-section');
    const closeCreateMeal = document.getElementById('close-create-meal');
    const createMealItems = document.querySelectorAll('.create-meal-item');

    openCreateMealBtn.addEventListener('click', function() {
        createMealSection.style.display = 'block';  
    })

    if (closeCreateMeal) {
        closeCreateMeal.addEventListener('click', function() {
            createMealSection.style.display = 'none';
        })
    }


    function openPopup() {
        if (popupOverlay) {
            popupOverlay.style.display = 'block';
        }
    }
    function closePopupFunc(){
        if (popupOverlay) {
            popupOverlay.style.display = 'none';
        }
    }

    if (closePopup) {
        closePopup.addEventListener('click', closePopupFunc);
    }

    if (popupOverlay) {
        popupOverlay.addEventListener('click', function (event){
            if (event.target === popupOverlay) {
                closePopupFunc()
            }
        });
    }

    if (cartIcon) {
        cartIcon.addEventListener('click', function (event) {
            openPopup()
        });
    }


    function toggleNav(){
        if (nav && nav.style.left == "-250px"){
            nav.style.left = "0px"; 
        } else if (nav) {
            nav.style.left = "-250px"; 
        }
    }

    if (navbtn) {
        navbtn.addEventListener('click', toggleNav);
    }

    var images = ['images/banner-img.jpeg', 'images/margherita.jpg', 'images/17-ice-cream-sundaes-in-a-pink-bowl-with-sprinkles.jpg', 'images/16.jpg'];
    var nextimage = 0;
    var hero = document.getElementById('hero');

    function doSlideShow(){
        if (nextimage >= images.length){nextimage=0;}
        if (hero) {
            hero.style.backgroundImage = 'url("'+ images[nextimage++] +'")';
            setTimeout(doSlideShow, 5000);
        }
    }
}

function initRegisterPage() {
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const feedback = document.getElementById('password-feedback');
        
        const lengthValid = password.length >= 8;
        const uppercaseValid = /[A-Z]/.test(password);
        const lowercaseValid = /[a-z]/.test(password);
        const numberValid = /\d/.test(password);
        const specialCharValid = /[\W_]/.test(password); // non-word character or underscore
    
        if (lengthValid && uppercaseValid && lowercaseValid && numberValid && specialCharValid) {
            feedback.textContent = "✅ Strong password";
            feedback.style.color = "green";
        } else {
            feedback.innerHTML = `
                ❌ Must be at least 8 characters<br>
                ❌ Include uppercase, lowercase, number, and special character
            `;
            feedback.style.color = "red";
        }
    });
    
}
function initAdminPage() {
    const xyValues = [
        {x: "JAN", y: 97},
        {x: "FEB", y: 115},
        {x: "MAR", y: 125},
        {x: "APR", y: 120},
        {x: "MAY", y: 0},
        {x: "JUN", y: 0},
        {x: "JUL", y: 0},
        {x: "AUG", y: 0},
        {x: "SEP", y: 0},
        {x: "OCT", y: 0},
        {x: "NOV", y: 0},
        {x: "DEC", y: 0},

    ]

    new Chart("myChart", {
        type: "bar",
        data : {
            datasets: [{
                label: "Total Sales",
                pointRadius: 4,
                pointBackgroundColor: "rgba(0,0,255,1)",
                data:xyValues
            }]
        },
        options: {
            parsing: {
                xAxisKey: 'x',
                yAxisKey: 'y'
            },
            scales: {
                x: {
                    type: 'category',
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Sales'
                    }
                }
            }
        }
    });

    var xValues = ["Chicken", "Pizzas", "Bowls", "Drinks", "Burgers", "Desserts"];
    var yValues = [55, 49, 44, 24, 15, 27];
    var barColors = [
        "#4e79a7", // soft blue
        "#f28e2b", // orange-yellow
        "#e15759", // soft red
        "#76b7b2", // teal
        "#59a14f", // green
        "#edc949"  // golden yellow
      ];

    new Chart("inventory", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Total Inventory"
            }
        }
    });
}

// Initialize checkout page functionality
function initCheckoutPage() {
    for (let i = 1; i <= 3; i++) {
        const button = document.getElementById(`drop${i}`);
        const section = document.getElementById(`${i}`);
    
        button.addEventListener("click", () => {
            section.classList.toggle("hidden");
        });
    }
}

function initKitchenPage() {
    function fetchNotifications() {
        fetch('notifications.php')
            .then(response => response.text()) // Get raw response text first
            .then(text => {
                if (!text) {
                    // No response (no new notifications)
                    return;
                }
    
                let data;
                try {
                    data = JSON.parse(text);
                } catch (e) {
                    console.error('JSON parse error:', e);
                    return;
                }
    
                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(order => {
                        showToast(`New order received: #${order.order_id}`);
                    });
                }
            })
            .catch(error => console.error('Notification fetch error:', error));
    }
    

    // Poll every 10 seconds
    setInterval(fetchNotifications, 10000);

    // Optional: Fetch immediately on load
    fetchNotifications();

    function showToast(message) {
        const container = document.getElementById('notification-container');
        const toast = document.createElement('div');
        toast.className = 'toast';
    
        toast.innerHTML = `
            <img src="images/logo.png" alt="Logo" class="toast-icon">
            <span>${message}</span>
        `;
    
        container.appendChild(toast);
    
        const sound = document.getElementById('notification-sound');
        if (sound) sound.play();
    
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }

}