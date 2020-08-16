function redirectToLogin(){
    window.location.replace("login.html");
}

function load_search_results(){
    var searchResults = new XMLHttpRequest();
    searchResults.open('GET', '../js/search_results.json');
    
    searchResults.onload = function(){
        var result = JSON.parse(searchResults.responseText);
        render_search_HTML(result);
    };
    searchResults.send();
}

function render_search_HTML(data){
    var container = document.getElementById("search_results");
    var htmlstr = "";
    for(i=0; i<data.length; ++i){
        htmlstr += '<div class= "search-result">';
        htmlstr += '<p>' + data[i].username;
        htmlstr += 'who plays ' + data[i].instrument;
        htmlstr += 'in the genre ' + data[i].genre;
        htmlstr += 'and is located in ' + data[i].city;
        
        if(data[i].one_time == 1){
            htmlstr += '<p>is available for one time gigs</p>';
        }
        if(data[i].full_time == 1){
            htmlstr += '<p>is available to be a full time band member</p>';
        }
        
        
        htmlstr += '<a href="mailto:' + data[i].email + '"> Contact </a>';
        htmlstr += '</div>';
    }
    container.insertAdjacentHTML('beforeend', htmlstr);
}

function load_ads(){
    var ad_list = new XMLHttpRequest();
    ad_list.open('GET', '../js/ad_list.json');
    
    ad_list.onload = function(){
        var result = JSON.parse(ad_list.responseText);
        render_ads_HTML(result);
    };
    ad_list.send();
}

function render_ads_HTML(data){
    var container = document.getElementById("ad_list");
    var htmlstr = "";
    for(i=0; i<data.length; i++){
    htmlstr += '<div class="search-result">'
        htmlstr += '<p>' + data[i].band + '</p>';
        if(data[i].instrument !== ""){
            htmlstr += '<p> is looking for someone who plays ' + data[i].instrument + '</p>';
        }
        if(data[i].genre !== ""){
        htmlstr += '<p> in the genre ' + data[i].genre + '</p>';
        }
        if(data[i].city !== ""){
        htmlstr += '<p>who is located in ' + data[i].city + '</p>';
        }
        if(data[i].one_time == 1){
            htmlstr += '<p>who is available to play a one time gig </p>';
        }
        if(data[i].full_time){
            htmlstr+= 'who is available to be a full time band member</p>';
        }
        if(data[i].message !== ""){
        htmlstr += '<p> The band also included a personalized message: </p><p>' + data[i].message + '</p>';
        }
        htmlstr += '<a href="mailto:' + data[i].email + '"> Contact </a>';
        htmlstr += '</div>';
    }
    container.insertAdjacentHTML('beforeend', htmlstr);
}

function load_band_members(){
    var band_members = new XMLHttpRequest();
    band_members.open('GET', '../js/band_members.json');
    
    band_members.onload = function(){
        var result = JSON.parse(band_members.responseText);
        render_band_members_HTML(result);
    };
    band_members.send();
}

function render_band_members_HTML(data){
    var container = document.getElementById("band_members");
    var htmlstr = "";
    if(data.length === 0){
        htmlstr += '<div>';
        htmlstr += '<p>There are no registered band members under your band profile.  Add a registered musician as a band member.</p>';
        htmlstr += '</div>';
    }
    else{
        for(i=0; i<data.length; i++){
            htmlstr += '<div>'
            htmlstr += '<p>' + data[i].username + '</p>';
            htmlstr += '</div>';
        }
    }
    container.insertAdjacentHTML('beforeend', htmlstr);
}