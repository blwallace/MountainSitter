<html>
<head>
<title>Project Teton</title>
<link rel="stylesheet" href="/assets/css/bootstrap_v3_3_2.css">
<link rel="stylesheet" type="text/css" href="/assets/css/project.css">
<script src="/assets/js/jquery_v2_1_3.js"></script>
<script src="/assets/js/d3_v3_5_5.js"></script>

<script>

$(document).ready(function(){

//Live example from: https://gist.github.com/3589712
//https://groups.google.com/forum/?fromgroups=#!searchin/d3-js/windhistory.com/d3-js/0fYBKF8mYvE/0VXPUCBBtXsJ
//ksfo is taken from windhistory.com server
var data = {"info":{"lat":37.6169,"lon":-122.3828,"name":"SAN FRANCISCO INTERNATIONAL  AIRPORT","id":"KSFO"},"data":{"3:270":[592,14.1],"8:300":[566,12.7],"5:130":[18,7.4],"1:60":[71,6.1],"9:10":[45,4.4],"8:60":[18,3.8],"6:350":[20,8.1],"4:70":[20,4.9],"11:30":[52,4.4],"8:270":[705,14.7],"7:220":[64,5.7],"1:170":[148,11.3],"7:40":[26,4.6],"5:180":[68,9.3],"4:260":[476,15.4],"5:220":[83,7.7],"11:140":[84,7.5],"4:300":[202,11.8],"2:130":[156,10.3],"9:20":[63,4.6],"7:310":[195,10.9],"2:340":[40,7.5],"2:260":[179,10.4],"1:300":[76,8.7],"11:40":[37,4.4],"5:350":[17,7.6],"8:110":[2,4.5],"11:null":[1095,0.2],"7:250":[228,11.7],"12:20":[110,5.5],"6:10":[30,5.3],"11:320":[41,5.7],"2:290":[315,10.7],"11:280":[649,10.5],"8:280":[726,12.6],"9:260":[344,14.3],"1:270":[177,10.9],"10:300":[257,10.2],"3:350":[24,12.3],"10:80":[26,4.7],"4:160":[67,13],"2:null":[966,0.1],"2:30":[52,4.1],"1:310":[32,6.7],"10:60":[40,4.1],"6:170":[2,4],"12:270":[163,10.2],"12:90":[78,5.3],"3:20":[45,4.2],"9:310":[103,9.6],"10:150":[66,6.5],"11:350":[47,8.3],"12:170":[119,10.2],"6:270":[891,17.9],"11:210":[54,6.2],"9:200":[45,6.5],"9:250":[138,12.5],"3:120":[64,8.2],"4:110":[28,11.1],"2:40":[56,4.2],"7:170":[12,5.8],"10:10":[52,5],"10:270":[479,13.3],"8:20":[55,5.2],"5:70":[10,4.7],"12:300":[131,12.7],"8:330":[35,8],"8:230":[71,8.9],"2:160":[164,10.9],"4:340":[10,5.2],"3:220":[97,8],"4:180":[84,11.9],"1:10":[157,5.6],"11:100":[44,4.3],"5:170":[30,8.3],"6:300":[536,12.1],"9:60":[33,3.7],"10:190":[68,10.9],"7:210":[36,7.7],"12:60":[130,6.6],"6:50":[29,3.9],"1:180":[118,11.6],"7:350":[14,7.5],"2:300":[126,7.8],"1:220":[71,12.6],"5:250":[214,13.3],"9:100":[6,4.5],"5:310":[68,10.4],"8:240":[141,8.6],"4:330":[18,6.9],"4:230":[86,8.4],"1:130":[222,9.9],"1:80":[79,6],"11:170":[106,9.3],"2:230":[85,8.4],"3:310":[62,8.1],"3:null":[570,0.3],"1:290":[167,11.1],"8:140":[5,4],"8:90":[2,4],"7:320":[88,9.8],"12:130":[159,8.3],"6:230":[62,8],"11:250":[93,9.8],"3:60":[33,4.2],"7:280":[696,12.7],"1:340":[44,9.1],"10:350":[36,10],"11:310":[58,6.3],"12:290":[245,14.1],"4:150":[55,10.2],"6:190":[7,5],"3:80":[37,5],"10:220":[70,6.5],"10:50":[43,4.2],"9:350":[9,6.3],"3:360":[34,7.4],"5:30":[23,4.8],"12:340":[57,8.2],"12:180":[97,14],"11:220":[79,6.6],"6:280":[829,15.5],"3:10":[41,5.7],"12:220":[62,10.5],"6:120":[1,7],"3:260":[330,12.9],"5:100":[15,5.2],"1:50":[67,6.2],"4:40":[34,4.6],"8:70":[13,4.5],"6:340":[19,8.3],"8:200":[43,7.7],"2:190":[116,10.9],"7:70":[11,4],"1:140":[164,7.3],"4:270":[725,17.8],"3:210":[100,8.8],"5:190":[78,10.3],"8:360":[19,4.5],"11:130":[95,8.5],"3:180":[108,13.8],"10:120":[35,7.1],"2:120":[140,9],"7:360":[13,5.2],"2:270":[296,10.6],"10:360":[38,6.5],"5:360":[21,6.3],"11:50":[36,3.5],"11:290":[420,9.9],"6:20":[32,4.8],"12:10":[112,4.9],"7:240":[139,9.5],"4:200":[77,13.2],"8:290":[902,12],"9:150":[10,5.3],"8:190":[36,6.5],"1:260":[112,10.2],"10:310":[68,8.3],"3:320":[23,6.9],"3:50":[23,3.8],"12:260":[99,13.3],"6:160":[6,4.3],"9:320":[43,8.8],"12:80":[106,5.1],"11:340":[41,6.7],"12:140":[171,8.9],"11:260":[185,9.7],"6:240":[142,9.5],"10:160":[77,8.2],"6:310":[124,10.2],"3:130":[91,8.6],"10:210":[100,6.4],"2:100":[73,6.4],"9:210":[56,7.3],"10:180":[81,10.7],"4:100":[20,8.3],"2:50":[36,4.7],"7:100":[3,4.3],"4:80":[24,5.1],"10:260":[240,11],"8:30":[59,5.2],"12:310":[45,10.3],"5:60":[26,4.2],"8:120":[2,5],"8:320":[77,10.7],"2:150":[130,9],"9:180":[19,5.1],"3:250":[150,11.7],"9:50":[36,3.8],"6:330":[24,7.2],"4:10":[34,4.5],"5:140":[14,5.9],"1:190":[94,11.2],"7:200":[27,6],"5:320":[37,8.5],"1:210":[74,14],"6:60":[19,3.9],"12:50":[106,7.2],"9:110":[3,4.3],"4:60":[30,4.1],"7:null":[170,0.8],"9:140":[7,5.1],"11:10":[71,5.8],"9:290":[856,11.7],"5:240":[155,9.9],"8:250":[203,12.1],"4:320":[18,9.1],"4:240":[107,10.2],"9:330":[29,6.4],"11:80":[40,6.2],"11:160":[79,7.2],"7:30":[29,5.2],"1:100":[121,5.8],"2:80":[68,5.1],"5:null":[265,0.6],"2:200":[84,10.1],"8:170":[11,4.5],"9:360":[21,5.7],"1:280":[244,10.9],"7:330":[48,8],"9:160":[15,4.4],"12:100":[141,5.6],"6:200":[17,7.7],"10:320":[37,9.2],"2:330":[29,5],"11:300":[160,10],"8:null":[295,0.4],"4:140":[70,10.8],"3:170":[91,9],"10:250":[117,9.5],"6:180":[5,4.4],"12:280":[261,10.6],"10:40":[49,4.4],"3:160":[87,7.8],"12:350":[57,8.6],"5:20":[29,5],"6:80":[5,4],"2:10":[76,5.1],"6:290":[727,12],"12:190":[122,10.1],"9:null":[485,0.2],"11:230":[72,7.5],"10:130":[48,8.5],"12:210":[112,9.1],"5:200":[59,10.3],"3:290":[548,12.9],"1:40":[108,6.6],"3:100":[27,5.3],"4:50":[35,4.1],"7:150":[11,5.5],"9:90":[7,3.9],"8:40":[44,4.4],"5:90":[12,4.9],"2:180":[113,10.9],"8:210":[24,4.9],"3:200":[123,11.4],"8:350":[13,4.1],"4:280":[795,16],"11:120":[63,6.2],"3:190":[123,11.6],"8:100":[5,3.8],"4:360":[16,5.1],"1:30":[117,5],"4:20":[41,4.7],"5:290":[632,12.4],"6:30":[38,4.8],"8:130":[5,4.4],"1:320":[34,8.8],"2:360":[50,9],"9:240":[99,8.1],"11:60":[33,5],"5:270":[935,18.1],"7:90":[6,4.3],"7:270":[631,15.9],"10:null":[784,0.2],"4:210":[114,9.8],"9:120":[16,5.9],"8:180":[26,5.8],"11:190":[83,8.6],"7:60":[15,3.4],"9:30":[65,4.2],"1:250":[53,8.8],"7:180":[31,6.6],"3:330":[31,8.7],"4:null":[412,0.4],"10:100":[26,5.4],"1:110":[128,6.8],"3:40":[36,4.7],"6:250":[265,12.9],"9:230":[60,7.7],"12:150":[133,6.7],"12:250":[56,14.5],"6:150":[2,5],"2:240":[97,9.3],"11:270":[375,10],"10:170":[71,11.7],"3:140":[92,7.7],"10:200":[99,9.4],"4:90":[16,6.1],"4:130":[75,10.7],"2:60":[56,5.2],"10:30":[55,3.9],"12:320":[34,7],"5:110":[13,7.5],"5:50":[28,3.9],"10:290":[589,10.9],"1:350":[61,7],"9:190":[25,6.8],"5:120":[15,6.6],"8:310":[128,10.8],"1:70":[107,5.8],"3:240":[98,11.3],"9:40":[39,3.5],"9:340":[15,5.4],"5:150":[30,6.9],"2:110":[65,9],"6:320":[58,8.5],"5:330":[24,6.5],"9:280":[816,11.4],"11:20":[61,4.3],"12:40":[78,6],"6:70":[10,4.3],"7:50":[26,5.1],"1:160":[156,8.6],"7:230":[78,7],"5:230":[118,9.1],"8:260":[474,14.3],"4:310":[55,9],"4:250":[198,13.1],"11:90":[40,4.4],"2:140":[156,9.3],"11:150":[93,6.4],"7:20":[40,6],"1:null":[1341,0.1],"2:90":[68,4.6],"2:350":[36,11.5],"2:210":[88,9.6],"9:70":[27,3.5],"5:340":[16,6.1],"7:300":[693,12.6],"8:160":[8,4.6],"12:30":[93,5.7],"11:330":[47,5.9],"9:170":[22,5.4],"6:210":[26,7.7],"9:270":[600,13.2],"12:110":[107,6],"2:320":[35,6.8],"10:330":[38,8.5],"1:200":[92,12.8],"2:280":[450,11.9],"1:360":[110,7.1],"10:240":[66,7.3],"4:170":[74,12.2],"2:20":[59,5.1],"4:120":[24,8.6],"3:340":[33,12.4],"10:70":[34,5.1],"9:300":[484,12],"12:200":[135,7.9],"12:360":[120,6.5],"5:10":[30,5.5],"11:200":[78,7.5],"10:140":[69,7.9],"3:30":[47,4.3],"6:260":[592,17.3],"12:160":[175,8.9],"12:null":[1221,0.1],"3:280":[756,13.2],"9:80":[13,4],"3:110":[33,6.9],"6:360":[19,6],"7:160":[12,5.6],"5:80":[17,4.8],"8:50":[35,4.1],"8:340":[14,5.6],"2:170":[137,11.4],"8:220":[44,6.1],"3:230":[101,10.1],"4:350":[11,4.2],"4:290":[538,14.4],"4:190":[57,11.4],"5:210":[77,9.4],"11:110":[40,5.4],"1:20":[143,4.9],"5:160":[23,5.9],"10:90":[22,4.9],"4:30":[33,4.4],"5:280":[835,16],"1:150":[144,7.5],"6:40":[20,4.4],"12:70":[124,6.9],"7:260":[473,14.5],"10:340":[39,10.7],"2:310":[52,7.1],"1:230":[61,12],"7:340":[28,7.1],"5:260":[619,16],"5:300":[311,12.3],"7:80":[2,3],"11:70":[35,5.9],"4:220":[114,9.6],"9:130":[5,5.2],"7:10":[28,5.5],"1:120":[198,9.5],"1:90":[94,5.3],"11:180":[98,6.3],"1:240":[43,10],"6:null":[201,0.7],"7:190":[32,5.4],"2:220":[68,7.7],"10:110":[23,5.1],"3:300":[235,10.8],"8:150":[6,4.3],"8:80":[3,4],"6:220":[45,6.3],"12:120":[151,7.2],"11:240":[73,9.6],"9:220":[42,9],"6:140":[1,4],"7:290":[997,12.5],"12:240":[44,13.9],"3:70":[37,4.4],"2:250":[88,9],"1:330":[34,7.6],"11:360":[72,6.9],"10:230":[67,6.3],"3:150":[67,7.4],"3:90":[30,5.3],"10:20":[43,5],"7:120":[1,6],"8:10":[38,5.3],"5:40":[23,4.8],"12:330":[41,6.9],"6:90":[2,4],"2:70":[54,4.8],"10:280":[745,11.5],"6:130":[1,5],"12:230":[66,10.2]},"samples":59072};

//scroll to bottom to see how we call the drawBigWindrose function with the data


//we don't have a selectedMonthControl so we just turn on all the months
var months = [];
for(var i = 0; i < 12; i++) {
  months.push(true);
}


var svg = d3.select("svg");


//setup some containers to put the plots inside
var big = svg.append("g")
  .attr("id", "windrose")
  .attr("transform", "translate(" + [35, 100] + ")");


var avg = svg.append("g")
  .attr("id", "avg")
  .attr("transform", "translate(" + [464, 100] + ")");






// This is the core Javascript code for http://windhistory.com/
// I haven't done a full open source release, but I figured I'd put the most important
// D3 code out there for people to learn from.   --nelson@monkey.org

/** Common wind rose code **/

// Function to draw a single arc for the wind rose
// Input: Drawing options object containing
//   width: degrees of width to draw (ie 5 or 15)
//   from: integer, inner radius
//   to: function returning the outer radius
// Output: a function that when called, generates SVG paths.
//   It expects to be called via D3 with data objects from totalsToFrequences()
var arc = function(o) {
    return d3.svg.arc()
        .startAngle(function(d) { return (d.d - o.width) * Math.PI/180; })
        .endAngle(function(d) { return (d.d + o.width) * Math.PI/180; })
        .innerRadius(o.from)
        .outerRadius(function(d) { return o.to(d) });
};

/** Code for data manipulation **/

// Convert a dictionary of {direction: total} to frequencies
// Output is an array of objects with three parameters:
//   d: wind direction
//   p: probability of the wind being in this direction
//   s: average speed of the wind in this direction
function totalsToFrequencies(totals, speeds) {
    var sum = 0;
    // Sum all the values in the dictionary
    for (var dir in totals) {
        sum += totals[dir];
    }
    if (sum == 0) {  // total hack to work around the case where no months are selected
        sum = 1;
    }
    
    // Build up an object containing frequencies
    var ret = {};
    ret.dirs = []
    ret.sum = sum;
    for (var dir in totals) {
        var freq = totals[dir] / sum;
        var avgspeed;
        if (totals[dir] > 0) { 
            avgspeed = speeds[dir] / totals[dir];
        } else {
            avgspeed = 0;
        }
        if (dir == "null") {   // winds calm is a special case
            ret.calm = { d: null, p: freq, s: null };
        } else {
            ret.dirs.push({ d: parseInt(dir), p: freq, s: avgspeed });
        }
    }
    return ret;
}

// Filter input data, giving back frequencies for the selected month 

//BW NOTES: Insert custom data here. totals and speed to use json format...
// {degree:value}  the bigger the value the bigger the pie
// {10:714, 20:721, .... , 360: 533}

function rollupForMonths(d, months) {
    var totals = {}, speeds = {};
    for (var i = 10; i < 361; i += 10) { totals[""+i] = 0; speeds[""+i] = 0 }
    totals["null"] = 0; speeds["null"] = 0;
     
    for (var key in d.data) {
        var s = key.split(":");
        if (s.length == 1) {
            var direction = s[0];
        } else {
            var month = s[0];
            var direction = s[1];
        }
        
        if (months && !months[month-1]) { continue; }
        
        // count up all samples with this key
        totals[direction] += d.data[key][0];
        // add in the average speed * count from this key
        speeds[direction] += d.data[key][0] * d.data[key][1];  
    }

    console.log(totals);

    return totalsToFrequencies(totals, speeds);
}

/** Code for big visualization **/

// Transformation to place a mark on top of an arc
function probArcTextT(d) {
    var tr = probabilityToRadius(d);
    return "translate(" + visWidth + "," + (visWidth-tr) + ")" +
           "rotate(" + d.d + ",0," + tr + ")"; };
function speedArcTextT(d) {
    var tr = speedToRadius(d);
    return "translate(" + visWidth + "," + (visWidth-tr) + ")" +
           "rotate(" + d.d + ",0," + tr + ")"; };   

// Return a string representing the wind speed for this datum
function speedText(d) { return d.s < 10 ? "" : d.s.toFixed(0); };
// Return a string representing the probability of wind coming from this direction
function probabilityText(d) { return d.p < 0.02 ? "" : (100*d.p).toFixed(0); };

// Map a wind speed to a color
var speedToColorScale = d3.scale.linear()
                          .domain([5, 25])
                          .range(["hsl(220, 70%, 90%)", "hsl(220, 70%, 30%)"])
                          .interpolate(d3.interpolateHsl);
function speedToColor(d) { return speedToColorScale(d.s); }
// Map a wind probability to a color                     
var probabilityToColorScale = d3.scale.linear()
                                .domain([0, 0.2])
                                .range(["hsl(0, 70%, 99%)", "hsl(0, 70%, 40%)"])
                                .interpolate(d3.interpolateHsl);
function probabilityToColor(d) { return probabilityToColorScale(d.p); }
                                
// Width of the whole visualization; used for centering               
var visWidth = 200;

// Map a wind probability to an outer radius for the chart      
var probabilityToRadiusScale = d3.scale.linear().domain([0, 0.15]).range([34, visWidth-20]).clamp(true);
function probabilityToRadius(d) { return probabilityToRadiusScale(d.p); }
// Map a wind speed to an outer radius for the chart      
var speedToRadiusScale = d3.scale.linear().domain([0, 20]).range([34, visWidth-20]).clamp(true);
function speedToRadius(d) { return speedToRadiusScale(d.s); }

// Options for drawing the complex arc chart
var windroseArcOptions = {
    width: 5,
    from: 34,
    to: probabilityToRadius
}   
var windspeedArcOptions = {
    width: 5,
    from: 34,
    to: speedToRadius
}
// Draw a complete wind rose visualization, including axes and center text
function drawComplexArcs(parent, plotData, colorFunc, arcTextFunc, complexArcOptions, arcTextT) {
    // Draw the main wind rose arcs
    parent.append("svg:g")
        .attr("class", "arcs")
        .selectAll("path")
        .data(plotData.dirs)
      .enter().append("svg:path")
        .attr("d", arc(complexArcOptions))
        .style("fill", colorFunc)
        .attr("transform", "translate(" + visWidth + "," + visWidth + ")")
      .append("svg:title")
        .text(function(d) { return d.d + "\u00b0 " + (100*d.p).toFixed(1) + "% " + d.s.toFixed(0) + "kts" });
        
    // Annotate the arcs with speed in text
    if (false) {    // disabled: just looks like chart junk
        parent.append("svg:g")
            .attr("class", "arctext")
            .selectAll("text")
            .data(plotData.dirs)
          .enter().append("svg:text")
            .text(arcTextFunc)
            .attr("dy", "-3px")
            .attr("transform", arcTextT);
    }

    // Add the calm wind probability in the center
    var cw = parent.append("svg:g").attr("class", "calmwind")
        .selectAll("text")
        .data([plotData.calm.p])
        .enter();
    cw.append("svg:text")
        .attr("transform", "translate(" + visWidth + "," + visWidth + ")")
        .text(function(d) { return Math.round(d * 100) + "%" });
    cw.append("svg:text")
        .attr("transform", "translate(" + visWidth + "," + (visWidth+14) + ")")
        .attr("class", "calmcaption")
        .text("calm");
}

// Update the page text after the data has been loaded
// Lots of template substitution here
function updatePageText(d) {
    if (!('info' in d)) {
        // workaround for stations missing in the master list
        d3.selectAll(".stationid").text("????")
        d3.selectAll(".stationname").text("Unknown station");
        return;
    }
    document.title = "Wind History for " + d.info.id;
    d3.selectAll(".stationid").text(d.info.id);
    d3.selectAll(".stationname").text(d.info.name.toLowerCase());

    var mapurl = 'map.html#10.00/' + d.info.lat + "/" + d.info.lon;  
    d3.select("#maplink").html('<a href="' + mapurl + '">' + d.info.lat + ', ' + d.info.lon + '</a>');
    d3.select("#whlink").attr("href", mapurl);

    var wsurl = 'http://weatherspark.com/#!dashboard;loc=' + d.info.lat + ',' + d.info.lon + ';t0=01/01;t1=12/31';
    d3.select("#wslink").attr("href", wsurl);
    
    var wuurl = 'http://www.wunderground.com/cgi-bin/findweather/getForecast?query=' + d.info.id;
    d3.select("#wulink").attr("href", wuurl);
    
    var vmurl = 'http://vfrmap.com/?type=vfrc&lat=' + d.info.lat + '&lon=' + d.info.lon + '&zoom=10';
    d3.select("#vmlink").attr("href", vmurl);
    
    var rfurl = 'http://runwayfinder.com/?loc=' + d.info.id;
    d3.select("#rflink").attr("href", rfurl);
    
    var nmurl = 'http://www.navmonster.com/apt/' + d.info.id;
    d3.select("#nmlink").attr("href", nmurl);
}

// Update all diagrams to the newly selected months
function updateWindVisDiagrams(d) {
    updateBigWindrose(d, "#windrose");
    updateBigWindrose(d, "#windspeed");
}

// Update a specific digram to the newly selected months
function updateBigWindrose(windroseData, container) {
    var vis = d3.select(container).select("svg");
    var rollup = rollupForMonths(windroseData, selectedMonthControl.selected());

    if (container == "#windrose") {
        updateComplexArcs(vis, rollup, speedToColor, speedText, windroseArcOptions, probArcTextT);
    } else {
        updateComplexArcs(vis, rollup, probabilityToColor, probabilityText, windspeedArcOptions, speedArcTextT);
    }
}

// Update drawn arcs, etc to the newly selected months
function updateComplexArcs(parent, plotData, colorFunc, arcTextFunc, complexArcOptions, arcTextT) {
    // Update the arcs' shape and color
    parent.select("g.arcs").selectAll("path")
        .data(plotData.dirs)
        .transition().duration(200)
        .style("fill", colorFunc)
        .attr("d", arc(complexArcOptions));

    // Update the arcs' title tooltip
    parent.select("g.arcs").selectAll("path").select("title")
        .text(function(d) { return d.d + "\u00b0 " + (100*d.p).toFixed(1) + "% " + d.s.toFixed(0) + "kts" });
        
    // Update the calm wind probability in the center
    parent.select("g.calmwind").select("text")
        .data([plotData.calm.p])
        .text(function(d) { return Math.round(d * 100) + "%" });            
}

// Top level function to draw all station diagrams
function makeWindVis(station) {
    var url = "data/" + station + ".json";
    var stationData = null;
    d3.json(url, function(d) {
        stationData = d;
        updatePageText(d);        
        drawBigWindrose(d, "#windrose", "Frequency by Direction");
        drawBigWindrose(d, "#windspeed", "Average Speed by Direction");
        selectedMonthControl.setCallback(function() { updateWindVisDiagrams(d); });
    });

    selectedMonthControl = new monthControl(null);
    selectedMonthControl.install("#monthControlDiv");
}

// Draw a big wind rose, for the visualization
function drawBigWindrose(windroseData, container, captionText) {
    // Various visualization size parameters
    var w = 400,
        h = 400,
        r = Math.min(w, h) / 2,      // center; probably broken if not square
        p = 20,                      // padding on outside of major elements
        ip = 34;                     // padding on inner circle
        
    // The main SVG visualization element
    var vis = d3.select(container)
        .append("svg:svg")
        .attr("width", w + "px").attr("height", (h + 30) + "px");

    // Set up axes: circles whose radius represents probability or speed
    if (container == "#windrose") {
        var ticks = d3.range(0.025, 0.151, 0.025);
        var tickmarks = d3.range(0.05,0.101,0.05);
        var radiusFunction = probabilityToRadiusScale;
        var tickLabel = function(d) { return "" + (d*100).toFixed(0) + "%"; }
    } else {
        var ticks = d3.range(5, 20.1, 5);
        var tickmarks = d3.range(5, 15.1, 5);
        var radiusFunction = speedToRadiusScale;
        var tickLabel = function(d) { return "" + d + "kts"; }
    }

    // Circles representing chart ticks
    vis.append("svg:g")
        .attr("class", "axes")
      .selectAll("circle")
        .data(ticks)
      .enter().append("svg:circle")
        .attr("cx", r).attr("cy", r)
        .attr("r", radiusFunction);
    // Text representing chart tickmarks
    vis.append("svg:g").attr("class", "tickmarks")
        .selectAll("text")
        .data(tickmarks)
      .enter().append("svg:text")
        .text(tickLabel)
        .attr("dy", "-2px")
        .attr("transform", function(d) {
            var y = visWidth - radiusFunction(d);
            return "translate(" + r + "," + y + ") " })
            
    // Labels: degree markers
    vis.append("svg:g")
      .attr("class", "labels")
      .selectAll("text")
        .data(d3.range(30, 361, 30))
      .enter().append("svg:text")
        .attr("dy", "-4px")
        .attr("transform", function(d) {     
            return "translate(" + r + "," + p + ") rotate(" + d + ",0," + (r-p) + ")"})        
        .text(function(dir) { return dir; });

    //var rollup = rollupForMonths(windroseData, selectedMonthControl.selected());
    var rollup = rollupForMonths(windroseData, months);

  
    if (container == "#windrose") {
        drawComplexArcs(vis, rollup, speedToColor, speedText, windroseArcOptions, probArcTextT);
    } else {
        drawComplexArcs(vis, rollup, probabilityToColor, probabilityText, windspeedArcOptions, speedArcTextT);
    }
    vis.append("svg:text")
       .text(captionText)
       .attr("class", "caption")
       .attr("transform", "translate(" + w/2 + "," + (h + 20) + ")");
}

/** Code for small wind roses **/

// Plot a small wind rose with the specified percentage data
//   parent: the SVG element to put the plot on
//   plotData: a list of 12 months, each a list of 13 numbers. plotData[month][0] is winds calm percentage,
//     plotData[month][1, 2, 3...] is percentage of winds at 30 degrees, 60, 90, ...
var smallArcScale = d3.scale.linear().domain([0, 0.15]).range([5, 30]).clamp(true)
var smallArcOptions = {
    width: 15,
    from: 5,
    to: function(d) { return smallArcScale(d.p); }
}
    
function plotSmallRose(parent, plotData) {
    var winds = [];
    //var months = selectedMonthControl.selected();
  
    // For every wind direction (note: skip plotData[0], winds calm)
    for (var dir = 1; dir < 13; dir++) {
        // Calculate average probability for all selected months
        var n = 0; sum = 0;
        for (var month = 0; month < 12; month++) {
            if (months[month]) {
                n += 1;
                sum += plotData[month][dir];
            }
        }
        var avg = sum/n;
        winds.push({d: dir * 30, p: avg / 100});
    }
    parent.append("svg:g")
        .selectAll("path")
        .data(winds)
      .enter().append("svg:path")
        .attr("d", arc(smallArcOptions));
    parent.append("svg:circle")
        .attr("r", smallArcOptions.from);
}









drawBigWindrose(data, "#windrose", "caption")
drawBigWindrose(data, "#avg", "caption")
  
  
  
//need to reformat the data to get smallPlot to work, not sure how yet
//var rollup = rollupForMonths(data, months);
//var small = svg.append("g")
//.attr("id", "small");
//plotSmallRose(small, rollup)
  
  

//Style the plots, this doesn't capture everything from windhistory.com  
svg.selectAll("text").style( { font: "14px sans-serif", "text-anchor": "middle" });

svg.selectAll(".arcs").style( {  stroke: "#000", "stroke-width": "0.5px", "fill-opacity": 0.9 })
svg.selectAll(".caption").style( { font: "18px sans-serif" });
svg.selectAll(".axes").style( { stroke: "#aaa", "stroke-width": "0.5px", fill: "none" })
svg.selectAll("text.labels").style( { "letter-spacing": "1px", fill: "#444", "font-size": "12px" })
svg.selectAll("text.arctext").style( { "font-size": "9px" })

});
</script>
</head>



<body>
<div class = "container">
	<div class="row">

    	<h3>
    		<?php 
		    echo $this->session->flashdata('site_error');
		     ?>	
    	</h3>

		<div class="col-xs-12">
			<div class="intro">
				<h1>Welcome!</h1>
				<h4><a href="/sites">See All Sites</a></h4>
				<h4><a href="/recordings">See All Recordings</a></h4>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="mountain">
				<form action='/sites/add' method='post'>
					<p>Enter Mountain to Load</p>
        			<input type="text" placeholder="ENTER PWS" name = 'site' class="form-control">
      				<button type="submit" class="btn btn-success">Submit</button>
      			</form>
			</div>
		<svg width="2000" height="650">
		</svg>	
		</div>
	</div>
</div>
