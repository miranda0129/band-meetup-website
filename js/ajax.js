function searchInstrument(){
    var instrument = document.getElementById('instrument').value;
    if (instrument !== ""){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var msg = this.responseText;
                document.getElementById("table_ajax").innerHTML = msg;
            }
        };
        xmlhttp.open("GET", "table_div.php?instreument" + instrument, true);
        xmlhttp.send();
    }
}