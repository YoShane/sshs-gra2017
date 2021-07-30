(function(window,factory){'use strict';if(typeof define==='function'&&define.amd){define(['get-size/get-size','isotope/js/layout-mode','fizzy-ui-utils/utils'],factory);}else if(typeof exports==='object'){module.exports=factory(require('get-size'),require('isotope-layout/js/layout-mode'),require('fizzy-ui-utils'));}else{factory(window.getSize,window.Isotope.LayoutMode,window.fizzyUIUtils);}}(window,function factory(getSize,LayoutMode,utils){'use strict';var MasonryHorizontal=LayoutMode.create('masonryHorizontal');MasonryHorizontal.prototype._resetLayout=function(){this.getRowHeight();this._getMeasurement('gutter','outerHeight');this.rowHeight+=this.gutter;this.rows=Math.floor((this.isotope.size.innerHeight+this.gutter)/this.rowHeight);this.rows=Math.max(this.rows,1);var i=this.rows;this.rowXs=[];while(i--){this.rowXs.push(0);}this.maxX=0;};MasonryHorizontal.prototype._getItemLayoutPosition=function(item){item.getSize();var rowSpan=Math.ceil(item.size.outerHeight/this.rowHeight);rowSpan=Math.min(rowSpan,this.rows);var rowGroup=this._getRowGroup(rowSpan);var minimumX=Math.min.apply(Math,rowGroup);var shortRowIndex=utils.indexOf(rowGroup,minimumX);var position={x:minimumX,y:this.rowHeight*shortRowIndex};var setWidth=minimumX+item.size.outerWidth;var setSpan=this.rows+1-rowGroup.length;for(var i=0;i<setSpan;i++){this.rowXs[shortRowIndex+i]=setWidth;}return position;};MasonryHorizontal.prototype._getRowGroup=function(rowSpan){if(rowSpan<2){return this.rowXs;}var rowGroup=[];var groupCount=this.rows+1-rowSpan;for(var i=0;i<groupCount;i++){var groupRowXs=this.rowXs.slice(i,i+rowSpan);rowGroup[i]=Math.max.apply(Math,groupRowXs);}return rowGroup;};MasonryHorizontal.prototype._manageStamp=function(stamp){var stampSize=getSize(stamp);var offset=this.isotope._getElementOffset(stamp);var firstY=this.isotope.options.isOriginTop?offset.top:offset.bottom;var lastY=firstY+stampSize.outerHeight;var firstRow=Math.floor(firstY/this.rowHeight);firstRow=Math.max(0,firstRow);var lastRow=Math.floor(lastY/this.rowHeight);lastRow=Math.min(this.rows-1,lastRow);var stampMaxX=(this.isotope.options.isOriginLeft?offset.left:offset.right)+stampSize.outerWidth;for(var i=firstRow;i<=lastRow;i++){this.rowXs[i]=Math.max(stampMaxX,this.rowXs[i]);}};MasonryHorizontal.prototype._getContainerSize=function(){this.maxX=Math.max.apply(Math,this.rowXs);return{width:this.maxX};};MasonryHorizontal.prototype.needsResizeLayout=function(){return this.needsVerticalResizeLayout();};return MasonryHorizontal;}));