<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Mapper</title>
    <link rel="shortcut icon" href="img/mapper-48.png">

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"></script>

    <script src='lib/jquery-ui-1.12.1.custom/jquery-ui.min.js'></script>
    <link rel="stylesheet" href="lib/jquery-ui-1.12.1.custom/jquery-ui.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <script src='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.css' rel='stylesheet' />

    <script src='https://unpkg.com/leaflet.sync@0.2.4/L.Map.Sync.js'></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/iso8601-js-period@0.2.1/iso8601.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/leaflet-timedimension@1.1.1/dist/leaflet.timedimension.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-timedimension@1.1.1/dist/leaflet.timedimension.control.min.css" />

    <style>
        html {
            font-size: 14px;
            font-family: Arial;
        }

	a {
	    text-decoration: none;
	}

        .row {
            padding: 5px 0px;
        }

        #sidebar-icon {
            position: relative;
            top: -35px;
            left: 385px;
            font-size: 20px;
            -webkit-text-stroke: 3px;
	    z-index: 1000;
        }

        .line {
            width: 100%;
            height: 5px;
            border-bottom: 3px solid gray;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        .sidebar-header {
            margin-left: 10px;
            margin-right: 35px;
            margin-bottom: 80px;
            margin-top: 5px;
        }

        .sidebar-body {
            margin-left: 10px;
            margin-right: 35px;
        }

        #sidebar {
            min-width: 420px;
            max-width: 420px;
            background: lightgray;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -390px;
        }

        #mapSpace {
            width: 100%;
            min-height: 100vh;
            margin-left: 10px;
        }

        .mapContainer {
            float: left;
            padding: 5px 5px 20px 5px;
            border: 1px solid lightgray;
            border-radius: 5px;
            margin-top: 10px;
            margin-right: 10px;
        }

        .mapContainer:hover {
            visibility: visible;
        }

        .mapTitle {
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
	    float: left;
	    max-width: 90%;
        }

        .mapControls {
            font-size: 14px;
            visibility: hidden;
	    float: right;
        }

        .mapContainer:hover>*>.mapControls {
            visibility: visible;
        }

        .leaflet-bar-timecontrol {
            visibility: hidden;
        }

        .mapContainer:hover>*>*>*>*>.leaflet-bar-timecontrol {
            visibility: visible;
        }

	.legend {
            float: left; 
	    margin-left: 10px; 
            width: auto; 
            height: 250px;
	    clip-path: inset(0px 12px 0px 0px);
	}

        .fa {
            cursor: pointer;
            opacity: 0.8 !important;
        }

        .ui-resizable-handle {
            z-index: 1000 !important;
        }

        .leaflet-bar-timecontrol {
            font-size: 12px;
        }

        .slider-handle {
            width: 10px;
            height: 10px;
            margin-left: -5px !important;
            margin-top: 5px;
        }

        .label1 {
            width: 135px;
            display: inline-block;
        }

        .form-select-sm {
            width: 245px !important;
	    background-color: white;
	    outline: none;
	    border-color: black;
	    color: black;
        }

        #sidebar-grip {
            width: 30px;
            height: 100%;
            background-color: gray;
            position: absolute;
            left: 390px;
            top: 0px;
            opacity: 20%;
            cursor: w-resize;
            transition: all 0.3s;
        }

        #sidebar-icon {
            cursor: w-resize;
        }

        #sidebar-footer {
            position: absolute;
            bottom: 10px;
            color: gray;
        }

        .custom-tooltip {
            --bs-tooltip-bg: #ffffe0;
            --bs-tooltip-color: black !important;
            --bs-tooltip-opacity: 1 !important;
        }

	.tooltip-inner {
   	    text-align: left;
   	    font-style: italic;
        }

        #paletteInversed:checked {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        #paletteInversed:focus {
            box-shadow: none;
        }

        #alertWMS {
            position: absolute;
            top: 160px;
            left: 80px;
	    display: none;
        }

        #alertLink {
            position: absolute;
            top: 50px;
            left: 10px;
	    width: 1300px;
	    z-index: 1000;
	    display: none;
        }

        #range, #numColorBands {
            font-size: 12px;
        }

	#rangeSelect {
            width: 200px !important;
	    background-color: lightgray;
	}

        #removeRessource {
	    position: relative;
	    left: 25px;
	    width: 25px;
        }

	#ressourceToAdd {
	    width: 290px; 
	    outline: none;
	}

	#copyLink {
            position: absolute;
            top: 25px;
            right: 40px;
            color: #666;
            cursor: pointer;
            width: 20px;
	}

	#copyLink:hover {
	    color: #333;
	}
    </style>

    <script>
        $(document).ready(function() {

            //==============================================================================================
            $('[data-bs-toggle="tooltip"]').tooltip({
                'delay': {
                    show: 500,
                    hide: 0
                },
                'placement': 'bottom',
		'html': true
            });

            //==============================================================================================
            function round(v) {
                return Math.sign(v) * Math.round(Math.abs(v));
            }

            //==============================================================================================
            var Id = 0;
            var selectedId = 0;
            var map = {};
            var layer1 = {};
            var width = 500;
            var height = 400;
            var opacity = 100;

            //==============================================================================================
            function syncMaps() { // do all synchronizations (less efficient than a python itertools.permutations)
                listIds = Object.keys(map);
                for (i in listIds) {
                    for (j in listIds) {
                        if (i != j) {
                            if (map[listIds[i]].link && map[listIds[j]].link) {
                                map[listIds[i]].sync(map[listIds[j]]);
                            } else {
                                map[listIds[i]].unsync(map[listIds[j]]);
                            }
                        }
                    }
                }
            }

            //==============================================================================================
            $(document).on('resize', '.mapContainer', function() {
                width = $(this).width();
                height = $(this).height();
                listIds = Object.keys(map);
                for (i in listIds) {
                    Id = listIds[i];
                    $('#mapContainer' + Id).width(width);
                    $('#mapContainer' + Id).height(height);
                    $('#map' + Id).width(width - 100);
                    $('#map' + Id).height(height - 40);
                    map[Id].invalidateSize();
                }
            });

            //==============================================================================================
            cmapArray = [
                "div-BrBG",
                "div-BuRd2",
                "div-BuRd",
                "div-PiYG",
                "div-PRGn",
                "div-PuOr",
                "div-RdBu",
                "div-RdGy",
                "div-RdYlBu",
                "div-RdYlGn",
                "div-Spectral",
                "psu-inferno",
                "psu-magma",
                "psu-plasma",
                "psu-viridis",
                "seq-BkBu",
                "seq-BkGn",
                "seq-BkRd",
                "seq-BkYl",
                "seq-BlueHeat",
                "seq-Blues",
                "seq-BuGn",
                "seq-BuPu",
                "seq-BuYl",
                "seq-cubeYF",
                "seq-GnBu",
                "seq-Greens",
                "seq-Greys",
                "seq-GreysRev",
                "seq-Heat",
                "seq-Oranges",
                "seq-OrRd",
                "seq-PuBuGn",
                "seq-PuBu",
                "seq-PuRd",
                "seq-Purples",
                "seq-RdPu",
                "seq-Reds",
                "seq-YlGnBu",
                "seq-YlGn",
                "seq-YlOrBr",
                "seq-YlOrRd",
                "x-Ncview",
                "x-Occam",
                "x-Rainbow",
                "x-Sst"
            ];

            //==============================================================================================
            $('#addMap').on('click', function() {

                //============================================
                Id++;
                selectedId = Id;

                divs = "<div class='mapContainer' id='mapContainer" + Id + "'>" +
                    "<div id='mapHeader" + Id + "' class='mapHeader'>" +
                    "<div id='mapTitle" + Id + "' class='mapTitle'></div>" +
                    "<div id='mapControls" + Id + "' class='mapControls'>" +
                    "<div id='mapLink" + Id + "' class='link fa fa-link fa-lg'></div>" +
                    "<div id='mapClose" + Id + "' class='close fa fa-regular fa-circle-xmark fa-lg'></div>" +
                    "</div>" +
                    "</div>" +
                    "<div style='display: table; width: 100%;'>" +
                    "<div id='map" + Id + "' class='map' style='float: left;'></div>" +
                    "<img id='legend" + Id + "' class='legend'></div>" +
                    "</div>" +
                    "</div>";
                $('#mapSpace').append(divs);

                //============================================
                //CRS_Code = "EPSG3857";
                CRS_Code = "EPSG4326";

                map[Id] = L.map('map' + Id, {
                    crs: L.CRS[CRS_Code],
                    center: [45, 0],
                    zoom: 3,
                    maxZoom: 13,
                    attributionControl: false,
                    zoomControl: false
                });

                //============================================
                ressource = $('#ressource').val();
                variable = $('#variable').val();
                variableLongname = $('#variable option:selected').text();
                elevation = $('#elevation').val();
                elevationText = $('#elevation option:selected').text();
                cmap = $('#changeCmap').val();
                numcolorbands = $('#changeNumColorBands').slider('getValue');
                inv = $('#paletteInversed').prop('checked');
                range = $('#changeRange').slider('getValue');
                rangeMin = $("#changeRange").slider('getAttribute', 'min');
                rangeMax = $("#changeRange").slider('getAttribute', 'max');
                rangeStep = $("#changeRange").slider('getAttribute', 'step');

                ressource = ressource.split('?')[0];		// remove ?service=WMS&version=1.3.0&request=GetCapabilities

                //============================================
                map[Id].link = true;
                map[Id].Parameters = {
                    'ressource': ressource,
                    'variable': variable,
                    'cmap': cmap,
                    'inv': inv,
                    'numcolorbands': numcolorbands,
                    'range': range,
                    'rangeMin': rangeMin,
                    'rangeMax': rangeMax,
                    'rangeStep': rangeStep
                };

                //console.log(map[Id].Parameters);
                updateLegend(Id);

                //============================================
                if (inv) {
                    cmap = cmap + "-inv";
                }

                //============================================
                $.get(ressource + "?request=GetCapabilities", function(xml) {
		        var layer = $(xml).find('Name').filter(function () {
        	            	return $(this).text() === $('#variable').val();
    		        }).parent();
		        var timeVariableArray = $(layer).find("Dimension[name='time']").text().trim();

                        var timeDimension = new L.TimeDimension({
                            times: timeVariableArray
                        });
                        map[Id].timeDimension = timeDimension;

                        if (timeVariableArray.length != 0) {
                            var player = new L.TimeDimension.Player({
                                    transitionTime: 100,
                                    loop: true,
                                    startOver: true
                                },
                                timeDimension
                            );

                            var timeDimensionControlOptions = {
                                player: player,
                                timeDimension: timeDimension,
                                position: "bottomleft",
                                autoPlay: false,
                                minSpeed: 1,
                                speedStep: 0.5,
                                maxSpeed: 15,
                                timeSliderDragUpdate: true
                            };

                            var timeDimensionControl = new L.Control.TimeDimension(
                                timeDimensionControlOptions
                            );
                            map[Id].addControl(timeDimensionControl);
                        }

                        //============================================
			// http://www2.demis.nl/worldmap/
			// http://www2.demis.nl/worldmap/wms.asp?REQUEST=GetMap&LAYERS=Coastlines,Borders&SRS=EPSG:4326&BBOX=-180,-90,180,90&WIDTH=600&HEIGHT=300&FORMAT=image/gif&STYLES=000000,AAAAAA&TRANSPARENT=TRUE
                        var layerCoastlines = L.tileLayer.wms('https://www2.demis.nl/worldmap/wms.asp', {
                            layers: 'Coastlines,Borders',
                            format: 'image/png',
                            styles: '000000,AAAAAA',
                            transparent: true
                        });

                        //============================================
            		ressource = $('#ressource option:selected').text();
			variableUnits = "";
            		$.get({ url: ressource + "?REQUEST=GetMetadata" + "&LAYERNAME=" + variable + "&ITEM=layerDetails",
				async:false
			      }, function(response) {
	    			variableUnits = response.units;
            		});

                        //============================================
                        var wmsLayer = L.tileLayer.wms(
                            ressource + "?", {
                                LAYERS: variable,
                                ELEVATION: (elevation == null) ? 0 : elevation,
                                COLORSCALERANGE: range,
                                NUMCOLORBANDS: numcolorbands,
                                STYLES: "raster/" + cmap,
                                ABOVEMAXCOLOR: "extend",
                                BELOWMINCOLOR: "extend",
                                FORMAT: "image/png",
                                OPACITY: opacity
                            }
                        );

                        layer1[Id] = L.timeDimension.layer.wms(wmsLayer);
                        layer1[Id].addTo(map[Id]);

                        layerCoastlines.addTo(map[Id]);
                        layerCoastlines.bringToFront();

                        $('#mapContainer' + Id).resizable({
                            minWidth: 480,
                            minHeight: 320
                        });
                        $('#mapContainer' + Id).width(width);
                        $('#mapContainer' + Id).height(height);
                        $('#map' + Id).width(width - 100);
                        $('#map' + Id).height(height - 40);
                        file = ressource.split('/').slice(-1)[0];
                        if (elevation == null) {
			   zTitle = "&nbsp;";
			} else {
			   zTitle = "Z=" + elevationText;
			}
                        $('#mapTitle' + Id).html(file + "<br>" + variableLongname + " [" + variableUnits + "]" + "<br>" + zTitle);

                        map[Id].invalidateSize();
                        syncMaps();

                        //$('#mapContainer' + Id).draggable();
                        $('#map' + Id).trigger("click");
                    });
            });

            //==============================================================================================
            $.each(cmapArray, function(i, text) {
                $('#changeCmap').append($('<option>', {
                    value: text,
                    text: text
                }));
            });
            $('#changeCmap').val('div-PRGn');

            //==============================================================================================
            $("#changeRange").slider({
                min: -100,
                max: 100,
                value: [-20, 20],
                step: 1,
                focus: true,
                tooltip: 'hide'
            });
            $("#range").text([-20, 20].join(' : '));

            //==============================================================================================
            $("#changeNumColorBands").slider({
                min: 2,
                max: 250,
                value: 40,
                step: 1,
                focus: true,
                tooltip: 'hide'
            });
            $("#numColorBands").text(40);

            //==============================================================================================
            function updateVariables() {
                ressource = $('#ressource').val();
                $.get({url: ressource,
		       async: false 
                      }, function(xml) {
		    var layers = $(xml).find('Layer[queryable=1]');
                    var variablesArray = [];
                    var variablesLongnameArray = [];
		    for(i=0; i<layers.length; i++) {
		    	variablesArray.push($(layers[i]).find('Name').first().text());
		    	variablesLongnameArray.push($(layers[i]).find('Title').first().text());
		    }
                    $('#variable').empty();
                    $.each(variablesArray, function(i, text) {
                        $('#variable').append($('<option>', {
                            value: text,
                            text: variablesLongnameArray[i]
                        }));
                    });
            	    $('#variable').trigger('change');
		    $('#addMap').prop("disabled", false);
		    $('#getLink').prop("disabled", false);
                });
            }

            //==============================================================================================
            $('#variable').on('change', function() {
                ressource = $('#ressource').val();
                variable = $('#variable').val();
                $.get(ressource, function(xml) {
		    var layer = $(xml).find('Name').filter(function () {
        			return $(this).text() === variable;
    		    }).parent();
		    var elevationVariableArray = $(layer).find("Dimension[name='elevation']").text().split(',').map(string => parseFloat(string));
		    //console.log("----", elevationVariableArray, elevationVariableArray.length);
		    var elevationVariableUnit = $(layer).find("Dimension[name='elevation']").attr("unitSymbol");
            	    $('#elevation').empty();
		    if (isNaN(elevationVariableArray[0])) {
		    	$('#elevation').prop("disabled", true);
		    } else {
		    	$('#elevation').prop("disabled", false);
			if (elevationVariableUnit != "") {
				elevationVariableUnitText = " (" + elevationVariableUnit + ")";
			} else {
				elevationVariableUnitText = "";
			}
            	    	$.each(elevationVariableArray, function(i, text) {
            	        	$('#elevation').append($('<option>', {
            	            		text: text + elevationVariableUnitText,
            	            		val: text
            	        	}));
            	        });
		    }
                });

            });

            //==============================================================================================
            $('#rangeSelect').on('change', function() {
            	setRange($('#rangeSelect').val());
            });

            //==============================================================================================
            function setRange(arg) {
		arrayArg = arg.split(":");
        	rangeMin = parseFloat(arrayArg[0]);
        	rangeMax = parseFloat(arrayArg[1]);
        	rangeStep = parseFloat(arrayArg[2]);
        	$("#changeRange").slider('setAttribute', 'min', rangeMin);
        	$("#changeRange").slider('setAttribute', 'max', rangeMax);
        	$("#changeRange").slider('setAttribute', 'step', rangeStep);
        	$("#changeRange").slider('refresh');
        	$("#changeRange").slider('setValue', [rangeMin, rangeMax]);
        	$('#changeRange').trigger('slideStop');
                if (map[selectedId] === undefined) return;
        	map[selectedId].Parameters.range = [rangeMin, rangeMax];
        	map[selectedId].Parameters.rangeStep = rangeStep;
        	map[selectedId].Parameters.rangeMin = rangeMin;
        	map[selectedId].Parameters.rangeMax = rangeMax;
	    }

            //==============================================================================================
	    $("#rangeAuto1").on("click", function () {
                if (map[selectedId] === undefined) return;
                layer = layer1[selectedId]._currentLayer.wmsParams['LAYERS'];
                elevation = layer1[selectedId]._currentLayer.wmsParams['ELEVATION'];
                url = layer1[selectedId]._currentLayer._url;
                $.get(url +
                	"REQUEST=GetMetadata&VERSION=1.1.1" +
                	"&LAYER=" + layer +
                	"&ELEVATION=" + elevation +
                	"&ITEM=minmax&SRS=EPSG:4326&BBOX=-180,-90,180,90&WIDTH=200&HEIGHT=200",
                	function(response) {
                		rangeMin = response.min;
                		rangeMax = response.max;
                    		rangeStep = (Math.abs(rangeMax - rangeMin) / 20).toPrecision(5);
                		if (rangeMin == rangeMax) return; 
				//console.log(rangeMin, rangeMax);
                		$("#changeRange").slider('setAttribute', 'min', rangeMin);
                		$("#changeRange").slider('setAttribute', 'max', rangeMax);
                		$("#changeRange").slider('setAttribute', 'step', rangeStep);
                		$("#changeRange").slider('refresh');
                		$("#changeRange").slider('setValue', [rangeMin, rangeMax]);
                		$('#changeRange').trigger('slideStop');
                		map[selectedId].Parameters.range = [rangeMin, rangeMax];
                		map[selectedId].Parameters.rangeStep = rangeStep;
                		map[selectedId].Parameters.rangeMin = rangeMin;
                		map[selectedId].Parameters.rangeMax = rangeMax;
			}
		);
            });

            //==============================================================================================
	    $("#rangeAuto2").on("click", function () {
                if (map[selectedId] === undefined) return;
            	layer = layer1[selectedId]._currentLayer.wmsParams['LAYERS'];
                elevation = layer1[selectedId]._currentLayer.wmsParams['ELEVATION'];
            	url = layer1[selectedId]._currentLayer._url;
            	$.get(url +
            		"REQUEST=GetMetadata&VERSION=1.1.1" +
            		"&LAYER=" + layer +
                	"&ELEVATION=" + elevation +
            		"&ITEM=minmax&SRS=EPSG:4326&BBOX=-180,-90,180,90&WIDTH=200&HEIGHT=200",
            		function(response) {
            			rangeMin = Math.round(response.min);
            			rangeMax = Math.round(response.max);
            	    		rangeStep = 1;
            			if (rangeMin == rangeMax) return; 
	    			//console.log(rangeMin, rangeMax);
            			$("#changeRange").slider('setAttribute', 'min', rangeMin);
            			$("#changeRange").slider('setAttribute', 'max', rangeMax);
            			$("#changeRange").slider('setAttribute', 'step', rangeStep);
            			$("#changeRange").slider('refresh');
            			$("#changeRange").slider('setValue', [rangeMin, rangeMax]);
            			$('#changeRange').trigger('slideStop');
            			map[selectedId].Parameters.range = [rangeMin, rangeMax];
            			map[selectedId].Parameters.rangeStep = rangeStep;
            			map[selectedId].Parameters.rangeMin = rangeMin;
            			map[selectedId].Parameters.rangeMax = rangeMax;
	    		}
	    	);
            });

            //==============================================================================================
            function addRessource(ressource) {
                ressourceText = ressource.split("?")[0];
		ressourceExists = $('#ressource option').filter(function() { 		// Check if ressource is already in options
    			return $(this).text() === ressourceText; 
		});
		if (ressourceExists.length == 0) {
                	$.get({url: ressource,
			       async: false 
                              }, function(xml) {
                		ressourceText = ressource.split("?")[0];
                        	$('#ressourceToAdd').val("");
                        	$('#ressource').append($('<option>', {
                        	    value: ressource,
                        	    text: ressourceText
                        	}));
                        	$('#ressource').val(ressource).change();
                    	})
                    	.fail(function() {
                    	    $("#alertWMS").show();
                    	    setTimeout(function() {
                    	        $("#alertWMS").hide();
                    	    }, 2000);
                    	});
		}
            }

            //==============================================================================================
            $('#addRessource').on('click', function(text) {
                ressource = $('#ressourceToAdd').val();
		if (ressource.trim() == "") return;
		addRessource(ressource);
            });

            //==============================================================================================
            $('#clearRessource').on('click', function(text) {
                $('#ressourceToAdd').val("");
            });

            //==============================================================================================
            $('#ressource').on('change', function() {
                updateVariables();
            });

            //==============================================================================================
            $('#changeCmap').on('change', function() {
                if (map[selectedId] === undefined) return;
                cmap = $('#changeCmap').val();
                numcolorbands = $('#changeNumColorBands').slider('getValue');
                map[selectedId].Parameters.cmap = cmap;
                inv = $('#paletteInversed').prop('checked');
                map[selectedId].Parameters.inv = inv;
                if (inv) {
                    cmap = cmap + "-inv";
                }
                layer1[selectedId]._currentLayer.wmsParams['STYLES'] = 'raster/' + cmap;
                layer1[selectedId]._currentLayer.redraw();
                layer1[selectedId]._baseLayer.options['STYLES'] = 'raster/' + cmap;
                updateLegend(selectedId);
            });

            //==============================================================================================
            $('#paletteInversed').on('change', function() {
                $('#changeCmap').trigger('change');
            });

            //==============================================================================================
            $('#changeRange').on('slideStop', function() {
                range = $('#changeRange').slider('getValue');
                $("#range").text(range.join(' : '));
                if (map[selectedId] === undefined) return;
                layer1[selectedId]._currentLayer.wmsParams['COLORSCALERANGE'] = range;
                layer1[selectedId]._currentLayer.redraw();
                layer1[selectedId]._baseLayer.options['COLORSCALERANGE'] = range;
                map[selectedId].Parameters.range = range;
                updateLegend(selectedId);
            });

            //==============================================================================================
            $('#changeNumColorBands').on('slideStop', function() {
                numcolorbands = $('#changeNumColorBands').slider('getValue');
                $("#numColorBands").text(numcolorbands);
                if (map[selectedId] === undefined) return;
                layer1[selectedId]._currentLayer.wmsParams['NUMCOLORBANDS'] = numcolorbands;
                layer1[selectedId]._currentLayer.redraw();
                layer1[selectedId]._baseLayer.options['NUMCOLORBANDS'] = numcolorbands;
                map[selectedId].Parameters.numcolorbands = numcolorbands;
                updateLegend(selectedId);
            });

            //==============================================================================================
            function updateLegend(Id) {
                $('#mapSpace > div').css("box-shadow", "none");
                $('#mapContainer' + Id).css("box-shadow", "0 20px 20px rgba(0,0,0,.5)");
                ressource = map[Id].Parameters.ressource;
                variable = map[Id].Parameters.variable;
                var cmap = map[Id].Parameters.cmap; // local var; cmap does not include -inv
                inv = $('#paletteInversed').prop('checked');
                if (inv) {
                    cmap = cmap + "-inv";
                }
                range = map[Id].Parameters.range;
                numcolorbands = map[Id].Parameters.numcolorbands
                legend = ressource +
                    "?REQUEST=GetLegendGraphic" +
                    "&LAYER=" + variable +
                    "&STYLES=raster/" + cmap +
                    "&COLORSCALERANGE=" + range +
                    "&NUMCOLORBANDS=" + numcolorbands +
                    "&WIDTH=20&HEIGHT=250"
                $('#legend' + Id).attr('src', legend);
            }

            //==============================================================================================
            function updateInputs(Id) {
                if (map[selectedId] === undefined) return;
                cmap = map[Id].Parameters.cmap;
                $('#changeCmap').val(cmap);
                range = map[Id].Parameters.range;
                rangeMin = map[Id].Parameters.rangeMin;
                rangeMax = map[Id].Parameters.rangeMax;
                rangeStep = map[Id].Parameters.rangeStep;
                numcolorbands = map[Id].Parameters.numcolorbands
                $("#changeRange").slider('setAttribute', 'min', rangeMin);
                $("#changeRange").slider('setAttribute', 'max', rangeMax);
                $("#changeRange").slider('setAttribute', 'step', rangeStep);
                $("#changeRange").slider('setValue', range);
                $("#range").text(range.join(' : '));
                $('#paletteInversed').prop('checked', map[Id].Parameters.inv);
                $("#changeNumColorBands").slider('setValue', numcolorbands);
                $("#numColorBands").text(numcolorbands);
                updateLegend(Id);
            }

            //==============================================================================================
            $(document).on('click', '.mapContainer', function() {
                mapContainerId = $(this)[0].id;
                selectedId = parseInt(mapContainerId.replace('mapContainer', ''));
                updateInputs(selectedId);
                //console.log(selectedId, map[selectedId].Parameters);
                $('#mapSpace > div').css("box-shadow", "none");
                $('#mapContainer' + selectedId).css("box-shadow", "0 20px 20px rgba(0,0,0,.5)");
            });

            //==============================================================================================
            $('#mapSpace').on('click', function() {
                $('#mapSpace > div').css("box-shadow", "none");
            });

            //==============================================================================================
            $(document).on('click', ".close", function() {
                closeId = $(this)[0].id;
                selectedId = parseInt(closeId.replace('mapClose', ''));
                $('#mapContainer' + selectedId).remove();
                delete map[selectedId];
                syncMaps();
                listIds = Object.keys(map);
                updateInputs(listIds[0]);
            });

            //==============================================================================================
            $('#sidebar-grip, #sidebar-icon').on('click', function(e) {
                $('#sidebar').toggleClass('active');
                $("#sidebar-icon").toggleClass('bi-chevron-left bi-chevron-right');
                if ($('#sidebar').hasClass('active')) {
                    $("#sidebar-grip").css('cursor', 'e-resize');
                    $("#sidebar-icon").css('cursor', 'e-resize');
                    $("#sidebar-grip").css('left', '0px');
                    $("#sidebar-footer").css('visibility', 'hidden');
                } else {
                    $("#sidebar-grip").css('cursor', 'w-resize');
                    $("#sidebar-icon").css('cursor', 'w-resize');
                    $("#sidebar-grip").css('left', '390px');
                    $("#sidebar-footer").css('visibility', 'visible');
                }
            });

            //==============================================================================================
            $(document).on('click', ".link", function() {
                linkId = $(this)[0].id;
                selectedId = parseInt(linkId.replace('mapLink', ''));
                $(this).toggleClass('fa-link fa-chain-broken');
                map[selectedId].link = !map[selectedId].link;
                syncMaps();
            });

            //==============================================================================================
            $("#alertWMS").hide();
            $("#alertLink").hide();

            //==============================================================================================
            $('#getLink').on('click', function() {
		if ($("#alertLink").is(":visible")) {
                	$("#alertLink").hide();
			return;
		}
                $("#alertLink").show();
		var values = new Array();
                $("#ressource option").each(function(){
                        values.push(this.text);
                });
		values.sort();
		alertLinkText = "https://webservices.ipsl.jussieu.fr/mapper/mapper.php?files=<br>" + values.join(',<br>');
                $("#alertLinkText").html(alertLinkText);
	    });

            //==============================================================================================
            $('#copyLink').on('click', function() {
		var values = new Array();
                $("#ressource option").each(function(){
                        values.push(this.text);
                });
		values.sort();
		link = "https://webservices.ipsl.jussieu.fr/mapper/mapper.php?files=" + values.join(',');
		navigator.clipboard.writeText(link);
	    });

            //==============================================================================================
	    $("#alertLinkClose").on("click", function () {
      		$("#alertLink").hide();
	    });

            //==============================================================================================
            $('#removeRessource').on('click', function() {
		$('#ressource option:selected').remove();
		if ($("#ressource").children('option').length == 0) {
	    		$('#variable').empty();
	    		$('#elevation').empty();
		    	$('#elevation').prop("disabled", true);
	    		$('#addMap').prop("disabled", true);
	    		$('#getLink').prop("disabled", true);
		} else {
            		$('#ressource').change();
		}
            });

            //==============================================================================================
            $('#ressourceToAdd').val("");
	    $('#addMap').prop("disabled", true);
	    $('#getLink').prop("disabled", true);

            //==============================================================================================
	    var ressourcesArray = <?php echo json_encode(explode(',', $_GET['files'])); ?>;
            $.each(ressourcesArray, function(i, ressource) {
		if (ressource.trim() == "") return;
		addRessource(ressource + "?service=WMS&request=GetCapabilities");
            });

            //######################################################################################################

        });
    </script>

</head>

<body>

    <div class="wrapper">
        <div id="sidebar">
            <div class="sidebar-header">
                <h3><a href="mapper.php" target="_blank">Mapper</a></h3>
                <span id="sidebar-icon" class="bi bi-chevron-left sidebar-icon"></span>
                <p>An interface to produce slippy maps using WMS (Web Map Service) layers from netCDF files exposed by the IPSL
                    <a target="_blank" href="https://thredds-su.ipsl.fr/thredds/catalog/ipsl_thredds/brocksce/GCA/Flux_Transcom/catalog.html">Thredds catalog</a>
                </p>
            </div>
            <div class="sidebar-body">
                <div class="row">
                    <div class="input-group" style="margin-bottom: 20px;">
                        <input type="text" autocomplete="off" class="form-control-sm" id="ressourceToAdd"
				data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" 
				data-bs-title="Enter a valid WMS ressource:<br>https://url?service=WMS&request=GetCapabilities">
                        <button class="btn btn-outline-dark btn-sm" type="button" id="clearRessource">Clear</button>
                        <button class="btn btn-outline-dark btn-sm" type="button" id="addRessource">Add</button>
                    </div>
                    <div class="label1">Ressource:<img src="img/delete-right.png" id="removeRessource"
					data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" 
					data-bs-title="Remove current selected ressource"></div>
                    <select class="form-select-sm" id="ressource">
                    </select>
                </div>
                <div class="row">
                    <div class="label1">Variable:</div>
                    <select class="form-select-sm" id="variable">
                    </select>
                </div>
                <div class="row">
                    <div class="label1">Elevation:</div>
                    <select class="form-select-sm" id="elevation" style="width: 150px !important;">
                    </select>
                </div>
                <div class="row gx-0" style="text-align: center;">
                    <div class="line"></div>
                </div>
                <div class="row">
                    <div class="label1">Palette:</div>
                    <select class="form-select-sm" id="changeCmap" style="width: 150px !important;">
                    </select>
                    <div style="width: 100px;">
                        <input class="form-check-input" type="checkbox" value="" id="paletteInversed">
                        <label class="form-check-label" for="paletteInversed">inversed</label>
                    </div>
                </div>
                <div class="row">
                    <div class="label1">Number of colorbands:</div>
                    <div style="width: 250px; text-align: center;">
                        <div id="numColorBands"></div>
                        <input id="changeNumColorBands" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="label1">Range:</div>
                    <div style="width: 250px; text-align: center;">
                        <div id="range"></div>
                        <input id="changeRange" type="text">
                        <div style="margin-top: 5px;">
                    	        <select class="form-select-sm" id="rangeSelect">
			        	<option>-20:20:1</option>
			        	<option>0:20:1</option>
			        	<option>0:100:1</option>
			        	<option>-100:100:5</option>
			        	<option>-1000:1000:10</option>
			        	<option>-3000:3000:100</option>
			        	<option>-10000:10000:100</option>
                    	        </select>
                        </div>
                        <div style="margin-top: 5px;">
                                <button class="btn btn-outline-dark btn-sm" type="button" id="rangeAuto1" 
					data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" 
					data-bs-title="Range set from min and max of the variable with 20 steps for selecting range">
					min,max,20 steps</button>
                                <button class="btn btn-outline-dark btn-sm" type="button" id="rangeAuto2"
					data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" 
					data-bs-title="Range set from int(min) and int(max) of the variable with 1 as range step value">
					min,max,step 1</button>
                        </div>
                    </div>
                </div>
                <div class="row gx-0" style="text-align: center;">
                    <div class="line"></div>
                </div>
                <div class="row" style="text-align: center;">
                    <button type="button" class="btn btn-primary" id="addMap" style="width: 120px; margin: 0 auto;">Add map</button>
                </div>
                <div class="row" style="text-align: center;">
                    <button type="button" class="btn btn-secondary" id="getLink" style="width: 200px; margin: 0 auto;">Show link</button>
                </div>
                <div id="sidebar-grip"></div>
                <div id="sidebar-footer" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" 
			data-bs-title="Contact: Patrick.Brockmann@lsce.ipsl.fr">&#169;LSCE - revision 2023/01/23
                </div>
            </div>
        </div>

        <div id='mapSpace'>

	</div>
    </div>

    <div class="alert alert-warning" id="alertWMS">
        <strong>Error: </strong>Not a valid WMS ressource
    </div>

    <div class="alert alert-primary alert-dismissible" role="alert" id="alertLink">
  	<strong>Link:</strong><div id="alertLinkText" style="font-size: 12px;"></div>
	<div id="copyLink" class="fa-regular fa-copy fa-lg"
                data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" 
		data-bs-title="Copy link"></div>
  	<button type="button" class="btn-close" id="alertLinkClose"></button>
    </div>

</body>

</html>
