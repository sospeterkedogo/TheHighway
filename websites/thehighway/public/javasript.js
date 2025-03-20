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
            console.log("opened")
        } else {
            nav.style.left = "-250px"; 
        }
    
        console.log("clicked")
    }

    navbtn.addEventListener('click', toggleNav);

    
    
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