$( document ).ready(function() {
    loadingInit();
});
function loadingInit() {
	// console.log('teste');
    var x = document.createElement("div");
    x.id = 'loading';
    x.className = 'loading';
    var y = document.createElement("span");
    x.appendChild(y);
    document.body.appendChild(x);
}
function loadingHide() {
    document.getElementById('loading').style.display = 'none';
}
function loadingShow() {
    document.getElementById('loading').style.display = 'block';
}