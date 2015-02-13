<?php session_start(); $username = $_SESSION['username']; session_write_close(); ?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/ff/css/slider.css" />
<style>
html, body {
	height: 100%;
	font-size:1em;
}

svg {
	width:100%;
	height:100%;
}
.datatip {
        border: 1px solid black;
        padding: 10px;
        background-color: white;
        opacity: 0.9;
        border-radius: 4px;
        box-shadow: 3px 4px 4px #ccc;
}

/* fixed header table */
.fixedtable {
	width: 100%;
	height: 350px;
	/* above is decorative or flexible */
	position: relative; /* could be absolute or relative */
	padding-top: 100px; /* height of header */
}

.fixedtable .fixed-table-container-inner {
	overflow-x: hidden;
	overflow-y: auto;
	height: 100%;
}
 
.fixedtable .header-background {
	height: 100px; /* height of header */
	position: absolute;
	top: 0;
	right: 0;
	left: 0;
}
.fixedtable table {
	width: 100%;
	overflow-x: hidden;
	overflow-y: auto;
}

.fixedtable .th-inner {
	-webkit-transform: translate(10px, 66px) rotate(315deg);
	width: 30px;
	position: absolute;
	top: 0;
	text-align: left;
	white-space:nowrap;
}
.fixedtable td {
	border-left:1px solid grey;
	padding-left: 5px;
}
.analyzer {
	display:none;
}

</style>
</head>
<body>
<div id="wrap">
<div id="main" class="container-fluid clear-top">
<h1>Funding Formula Finder</h1>
<div class="row-fluid questions">
</div>
<div class="row-fluid analyzer">
	<div id="controls" class="col-md-4 panel panel-default panel-body">
		Budget:<input type="text" id="budget" value="1000000000" />
	</div>
	<div class="panel panel-default col-md-8"><div id="map" class="panel-body"></div></div>
</div>
<div class="row-fluid analyzer">
	<div id="table" class="panel panel-default panel-body col-md-10 col-md-offset-1"> </div>
</div>
</div>
</div>
<!--<footer id="footer" class="text-center">(C) Copyright 2015</footer>-->
<script src="/js/jquery.min.js"></script>
<script src="/js/d3.js"></script>
<script src="/js/spin.min.js"></script>
<script src="/js/moment.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/ff/js/underscore.js"></script>
<script src="/ff/js/bootstrap-slider.js"></script>
<script>
window.ismobile = false;
(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))window.ismobile=true})(navigator.userAgent||navigator.vendor||window.opera);

$(document).ready(function(){
	init()
})

window.geo = {}
window.data = null
function init(){
	initquestions()
}

window.questions = [
	{
		question:'Which of these best coincides with your sense of fairness?',
		answers:{
			'From each according to his ability to each according to his need.':function(){},
			'Equal resources from the government for each person.':function(){}
		}
	},
	{
		question:'Should districts with more wadm get extra money?',
		answers:{
			'Yes.':function(){window.selectedattributes.push('wadm')}, // TODO make this the real attribute
			'No.':function(){}
		}
	},
	{
		question:'Should districts with more instruction get extra money?',
		answers:{
			'Yes.':function(){window.selectedattributes.push('instruction')}, // TODO make this the real attribute
			'No.':function(){}
		}
	}
]
function initquestions(){
	for(var i in questions){
		var q = questions[i]
		$('.questions').append( '<div id="q'+i+'" style="display:none;">'+q.question+'<br />'+$.map(q.answers, function(v,j){return '<button class="btn btn-default" qid="'+i+'" answer="'+j+'">'+j+'</button><br />'}).join('') + '</div>')
		for(var answer in q.answers){
			$('button[qid="'+i+'"][answer="'+answer+'"]').click(function(){
				var callback = window.questions[$(this).attr('qid')].answers[$(this).attr('answer')]
				console.log('clicked', $(this).attr('qid'), this, callback)
				callback()
				shownextquestion()
			})
		}
		showfirstquestion()
	}
}

function shownextquestion(){
	console.log('shownextquestion')
	$('#q'+window.questionindex).hide()
	window.questionindex++
	if(window.questionindex < window.questions.length){
		$('#q'+window.questionindex).show()
	}else{
		hidequestions()
		d3.json('districts.json', function(r){
		window.geo.districts = r
		d3.tsv('data.tsv', function(r){
		window.data = r
		window.counties = summarizedata(window.data)
		window.districts = window.data
		initanalyzer()
		})})
	}
}

window.questionindex = null
function showfirstquestion(){
	window.questionindex = -1
	shownextquestion()
}

function hidequestions(){
	$('.questions').hide()
}

function initanalyzer(){
	$('.analyzer').show()
	initbudget()
	initattributes()
	initfairnessmeasure()
	update()
	$(window).resize(update)
}

window.selectedattributes = []
function getweightfromui(attribute){
	return $('[attribute="'+attribute+'"]').val()
}
function getbudgetfromui(){
	return $('#budget').val()
}
function initbudget(){
	$('#budget').change(function(){
		update()
	})
}
function initattributes(){
	for(var i in window.selectedattributes){
		var a = window.selectedattributes[i]
		console.log(a)
		$('#controls').append(
			a+':<input type="text" class="slide span2" attribute="'+a+'" value="" data-slider-min="0" data-slider-max="50000" data-slider-step="5" data-slider-value="100" /><br /><br />'
		)
	}
	//$('.slide').slider().slider('destroy').slider()
	$('.slide').slider()
	$('.slide').on('slide', function(){
		update()
	})
}

function initfairnessmeasure(){
	console.error('implement initfairness')
}

function summarizedata(data){
	return $.map(d3.nest()
		.key(function(d){return d.county})
		.rollup(function(leaves){
			return {county:leaves[0].county,
				wadm:d3.sum(leaves, function(d){return d.wadm}),
				instruction:d3.sum(leaves, function(d){return d.instruction})
		}})
		.entries(window.data), function(n){return n.values})
}

function County(name){
	return $.map(window.counties, function(d){if(d.county == name){return d}})[0]
}
function District(name){
	return $.map(window.districts, function(d){if(d.district == name){return d}})[0]
}


function doupdate(){
	assignfunding()
	printtable('#table', window.data)
	updatemap()
}


var update = _.throttle(doupdate, 100)

window.budget
function assignfunding(){
	window.budget = getbudgetfromui()
	//determine relative scores
	for(var i in window.districts){
		computescore(window.districts[i])
	}
	var totalscore = d3.sum(window.districts, function(d){return d.score})
	// normalize to total budget
	for(var i in window.districts){
		var c = window.districts[i]
		c.funding = c.score/totalscore * window.budget
		c.funding_per_student = c.funding / c.wadm
	}
	console.log('assign funding', window.districts[0].funding, totalscore, window.budget, window.districts[0].funding_per_student)
}

function computescore(county){
	county.score = 0
	for(var i in window.selectedattributes){
		county.score += county[window.selectedattributes[i]]*getweightfromui(window.selectedattributes[i])
	}
}

window.map = {}
var datatip = d3.select("body")
	.append("div")
	.attr("class", "datatip")
	.style("position", "absolute")
	.style("z-index", "10")
	.style("visibility", "hidden")
	.style("display", "none")
	.text("a simple datatip");
	
function updatemap(){
	window.map.svg = window.map.svg || d3.select('#map').append('svg')
	var width = $('#map').width()
	var height = $('#map').height()

	var latcenter = 40.8
	var longcenter = 77.7

	var projection = d3.geo.albers()
		.center([0, latcenter])
		.rotate([longcenter, 0])
		.parallels([40, 41])
		.scale(10000)
		.translate([width / 2, height / 2]);

	var colorScale = d3.scale.linear()
		.domain([d3.min(window.districts, function(d){return d.funding_per_student}), d3.max(window.districts, function(d){return d.funding_per_student})])
		.range(['#000', '#fff'])
		.interpolate(d3.interpolateHcl)

	var districts = window.map.svg.selectAll('path.county')
		.data(window.geo.districts.features)
	districts.enter().append("path").classed('county', true)
		.attr("d", d3.geo.path().projection(projection))
 		.on("mousemove", function(event){return datatip.style("top", (d3.mouse(d3.select("body")[0][0])[1]-10)+"px").style("left",(d3.mouse(d3.select("body")[0][0])[0]+10)+"px");})
		.on("mouseover", function(){
			var g = d3.select(this).data()[0]
			var d = District(g.properties.SCHOOL_DIS)
			datatip.html(formattooltip(d))
			datatip.style("visibility", "visible").style('display', 'block')

		})
		.on("mouseout", function(){datatip.style('visibility', 'hidden').style('display', 'none')})
	districts
		.attr('title', function(d){return d.properties.name})
		.style('fill', function(d){return colorScale(District(d.properties.SCHOOL_DIS).funding_per_student)})

	//http://bost.ocks.org/mike/map/
}

function formattooltip(d){
	console.log(d)
	var str = $.map(window.selectedattributes, function(a){return '<b>'+a+':</b>'+d[a]}).join('<br />')
	return str
}

window.table = {}
function printtable(selector, data){
	window.table.container = d3.select(selector)
		.append('div').attr('class', 'fixedtable')

	window.table.headerbackground = window.table.headerbackground || window.table.container.append('div').attr('class', 'header-background')

	window.table.table = window.table.table || window.table.container.append('div').attr('class', 'fixed-table-container-inner')
		.append('table')
		.attr('cellspacing', 0)

	var headers = window.table.table.append('tr').classed('headers', true).selectAll('th').data(keys(data[0]))
	headers.enter().append('th')
		.append('div').classed('th-inner', true)
		.text(function(d){return d})
	var tr = window.table.table.selectAll('tr.regular').data(data)
	tr.enter().append('tr').classed('regular', true)
	var td = tr.selectAll('td').data(function(d){return d3.values(d)})
	td.enter().append('td')
		.text(function(d){return isdate(d) ? moment(d).fromNow() : d})
}

function showloading(target){
	$(target).css('opacity', 0.5)
	var opts = {
	lines: 13, // The number of lines to draw
	length: 20, // The length of each line
	width: 10, // The line thickness
	radius: 30, // The radius of the inner circle
	corners: 1, // Corner roundness (0..1)
	rotate: 0, // The rotation offset
	direction: 1, // 1: clockwise, -1: counterclockwise
	color: '#000', // #rgb or #rrggbb or array of colors
	speed: 1, // Rounds per second
	trail: 60, // Afterglow percentage
	shadow: false, // Whether to render a shadow
	hwaccel: false, // Whether to use hardware acceleration
	className: 'spinner', // The CSS class to assign to the spinner
	zIndex: 2e9, // The z-index (defaults to 2000000000)
	top: '50%', // Top position relative to parent
	left: '50%' // Left position relative to parent
	};
	window.spinner = new Spinner(opts).spin($(target)[0])
}
function hideloading(target){
	$(target).css('opacity', '')
	window.spinner.stop()
}
function keys(obj){
	var result = []
	for(var i in obj){
		result.push(i)
	}
	return result
}
function isdate(d){
	if((''+d).match(/\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d/)){
		return true
	}
	return false
}


</script>
</body>
</html>

