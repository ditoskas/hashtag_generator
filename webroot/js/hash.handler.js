"use strict";
var HashHandler = {};
//main namespace
HashHandler.Collection = (function(){
    var _hashtagsCollection = [];
    var _connectedListId = '#list-of-hashtags';
    return {
        /**
         * Generate a list of hashtags
         * @param data - array with hashtags
         */
        init:function(data){
            this.clear();
            for(var i =0; i < data.length; i++){
                _hashtagsCollection.push(new Hashtag(data[i]));
            }
        },
        /**
         * Clear the list of hashtags
         */
        clear:function(){
            _hashtagsCollection = [];
        },
        /**
         * Get the HashTag item based on index
         * @param index - index of the item
         * @returns {*}
         */
        getItem:function(index){
            return _hashtagsCollection[index];
        },
        /**
         * Append the items to the connected ul element
         */
        showOnList:function(){
            //empty the list
            $(_connectedListId).empty();
            if (_hashtagsCollection.length > 0){
                for(var i =0; i < _hashtagsCollection.length; i++){
                    $(_connectedListId).append(this.getItem(i).toListItem()).children(':last').hide().fadeIn(1000);
                }
            }
            else {
                $(_connectedListId).append('<li class="list-group-item">No hashtags found</li>')
            }
        }
    };
})(HashHandler.Collection);