function selectMenuItem(itemnumber) {
    let listitems = document.getElementById("menuitems").getElementsByTagName("li");
    var length = listitems.length;

    for(var i=0; i<= length; i++) {
        listitems[i].className = i+1 == itemnumber ? "selected" : "";
    }
}


document.addEventListener('DOMContentLoaded', function(){
    const popupOverlay = document.getElementById('popupOverlay');
    const popup = document.getElementById('popup');
    const closePopup = document.getElementById('closePopup');
    const cartIcon = document.getElementById('cart');
    const iteminfo = document.getElementsByClassName("iteminfo");
    const nav = document.getElementById("nav");
    const navbtn = document.getElementById("navbtn");

    function openPopup() {
        popupOverlay.style.display = 'block';
    }

    function closePopupFunc(){
        popupOverlay.style.display = 'none';
    }

    closePopup.addEventListener('click', closePopupFunc);

    popupOverlay.addEventListener('click', function (event){
        if (event.target === popupOverlay) {
            closePopupFunc()
        }
    });

    cartIcon.addEventListener('click', function (event) {
        openPopup()
    });

    

    function toggleNav(){
        
        if (nav.style.left == "-250px"){
            nav.style.left = "0px"; 
        } else {
            nav.style.left = "-250px"; 
        }
    }

    navbtn.addEventListener('click', toggleNav);

    var images = ['images/banner-img.jpeg', 'images/margherita.jpg', 'images/17-ice-cream-sundaes-in-a-pink-bowl-with-sprinkles.jpg', 'images/16.jpg'];

    var nextimage = 0;
    var hero = document.getElementById('hero');

    function doSlideShow(){
        if (nextimage >= images.length){nextimage=0;}
        hero.style.backgroundImage = 'url("'+ images[nextimage++] +'")';
        setTimeout(doSlideShow, 5000);
    }


    //doSlideShow();

    const xyValues = [
        {x: "JAN", y: 97},
        {x: "FEB", y: 115},
        {x: "MAR", y: 125},
        {x: "APR", y: 120},
        {x: "MAY", y: 127},
        {x: "JUN", y: 130},
        {x: "JUL", y: 155},
        {x: "AUG", y: 240},
        {x: "SEP", y: 200},
        {x: "OCT", y: 255},
        {x: "NOV", y: 138},
        {x: "DEC", y: 357},

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
    
});


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
    document.getElementById("floating-description").style.display = "none"; }


