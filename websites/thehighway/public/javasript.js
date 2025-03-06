function selectMenuItem(itemnumber) {
    let listitems = document.getElementById("menuitems").getElementsByTagName("li");
    var length = listitems.length;

    for(var i=0; i<= length; i++) {
        listitems[i].className = i+1 == itemnumber ? "selected" : "";
    }
}

function toggleNav(){
    const nav = document.getElementById("nav");
    nav.style.left = -250;
}

document.addEventListener('DOMContentLoaded', function(){
    const popupOverlay = document.getElementById('popupOverlay');
    const popup = document.getElementById('popup');
    const closePopup = document.getElementById('closePopup');
    const cartIcon = document.getElementById('cart');
    const iteminfo = document.getElementsByClassName("iteminfo");

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

    cartIcon.addEventListener('click', openPopup);

    for (let index = 0; index < iteminfo.length; index++) {
        iteminfo[index].addEventListener('click', openPopup);
    }
    

});

