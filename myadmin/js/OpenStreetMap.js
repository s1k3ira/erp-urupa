OpenLayers.Util.OSM={};OpenLayers.Util.OSM.MISSING_TILE_URL="http://www.openstreetmap.org/openlayers/img/404.png";OpenLayers.Util.OSM.originalOnImageLoadError=OpenLayers.Util.onImageLoadError;OpenLayers.Util.onImageLoadError=function(){if(this.src.match(/^http:\/\/[abc]\.[a-z]+\.openstreetmap\.org\//))this.src=OpenLayers.Util.OSM.MISSING_TILE_URL;else this.src.match(/^http:\/\/[def]\.tah\.openstreetmap\.org\//)};
OpenLayers.Layer.OSM.Mapnik=OpenLayers.Class(OpenLayers.Layer.OSM,{initialize:function(b,a){a=OpenLayers.Util.extend({numZoomLevels:19,buffer:0,transitionEffect:"resize"},a);OpenLayers.Layer.OSM.prototype.initialize.apply(this,[b,["http://a.tile.openstreetmap.org/${z}/${x}/${y}.png","http://b.tile.openstreetmap.org/${z}/${x}/${y}.png","http://c.tile.openstreetmap.org/${z}/${x}/${y}.png"],a])},CLASS_NAME:"OpenLayers.Layer.OSM.Mapnik"});
OpenLayers.Layer.OSM.Osmarender=OpenLayers.Class(OpenLayers.Layer.OSM,{initialize:function(b,a){a=OpenLayers.Util.extend({numZoomLevels:18,buffer:0,transitionEffect:"resize"},a);OpenLayers.Layer.OSM.prototype.initialize.apply(this,[b,["http://a.tah.openstreetmap.org/Tiles/tile/${z}/${x}/${y}.png","http://b.tah.openstreetmap.org/Tiles/tile/${z}/${x}/${y}.png","http://c.tah.openstreetmap.org/Tiles/tile/${z}/${x}/${y}.png"],a])},CLASS_NAME:"OpenLayers.Layer.OSM.Osmarender"});
OpenLayers.Layer.OSM.CycleMap=OpenLayers.Class(OpenLayers.Layer.OSM,{initialize:function(b,a){a=OpenLayers.Util.extend({numZoomLevels:19,buffer:0,transitionEffect:"resize"},a);OpenLayers.Layer.OSM.prototype.initialize.apply(this,[b,["http://a.tile.opencyclemap.org/cycle/${z}/${x}/${y}.png","http://b.tile.opencyclemap.org/cycle/${z}/${x}/${y}.png","http://c.tile.opencyclemap.org/cycle/${z}/${x}/${y}.png"],a])},CLASS_NAME:"OpenLayers.Layer.OSM.CycleMap"});
