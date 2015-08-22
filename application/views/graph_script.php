<script>

				$(document).ready(function(){


				//load json file with weather frequency from server
				var data = <?= $windhistory ?>;

				var svg = d3.select("#windrose_frame")
				            .append("svg")
				            .attr("width", "100%")
				            .attr("height", "100%");

				var svg2 = d3.select("#speedrose_frame")
				            .append("svg")
				            .attr("width", "100%")
				            .attr("height", "100%");


				//setup some containers to put the plots inside
				var big = svg.append("g")
				  .attr("id", "windrose")
				  // .attr("transform", "translate(" + [35, 35] + ")");


				var avg = svg2.append("g")
				  .attr("id", "avg")
				  // .attr("transform", "translate(" + [35, 35] + ")");

				drawBigWindrose(data, "#windrose", "caption")
				drawBigWindrose(data, "#avg", "caption")


				//Style the plots, this doesn't capture everything from windhistory.com  
				svg.selectAll("text").style( { font: "14px sans-serif", "text-anchor": "middle" });

				svg.selectAll(".arcs").style( {  stroke: "#000", "stroke-width": "0.5px", "fill-opacity": 1, fill:"blue" });
				svg.selectAll(".caption").style( { font: "18px sans-serif" });
				svg.selectAll(".axes").style( { stroke: "#aaa", "stroke-width": "0.5px", fill: "none" })
				svg.selectAll("text.labels").style( { "letter-spacing": "1px", fill: "#444", "font-size": "12px" })
				svg.selectAll("text.arctext").style( { "font-size": "9px" })

				svg2.selectAll("text").style( { font: "14px sans-serif", "text-anchor": "middle" });

				svg2.selectAll(".arcs").style( {  stroke: "#000", "stroke-width": "0.5px", "fill-opacity": 1, fill:"blue" });
				svg2.selectAll(".caption").style( { font: "18px sans-serif" });
				svg2.selectAll(".axes").style( { stroke: "#aaa", "stroke-width": "0.5px", fill: "none" })
				svg2.selectAll("text.labels").style( { "letter-spacing": "1px", fill: "#444", "font-size": "12px" })
				svg2.selectAll("text.arctext").style( { "font-size": "9px" })

				//create datepicker
				$(function() {
				    $( "#startdate" ).datepicker();
				  });
				$(function() {
				    $( "#enddate" ).datepicker();
				  });				
				});
			</script>