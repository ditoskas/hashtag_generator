"use strict";

function Hashtag(data){
    var _hashtag = data;
    /**
     * Privileged Methods
     * Getter method of hashtag
     * @returns {*}
     */
    this.getHashtag = function(){
        return _hashtag;
    };
};

//Public Methods
/**
 * Export a hashtag to li element
 * @returns {string}
 */
Hashtag.prototype.toListItem = function(){
    var html = '<li class="list-group-item">';
    html += '#'+this.getHashtag();
    html += '<div class="pull-right" >';
    html += this.getFacebookUrl();
    html += this.getTwitterUrl();
    html += this.getInstagramUrl();
    html += '</div>';
    html += '</li>';
    return html;
};
/**
 * Generate a link with an icon
 * @param url - Url of social site
 * @param icon - class icon
 * @returns {string}
 */
Hashtag.prototype.getSocialUrl = function(url,icon){
    return '<a href="' + url + '" class="social-icons" target="_blank" ><i class="' + icon + '"></i></a>';
};
/**
 * Get the facebook link icon
 * @returns {string}
 */
Hashtag.prototype.getFacebookUrl = function(){
    var url = 'https://www.facebook.com/search/top/?q=%23' + this.getHashtag();
    var icon = 'fa fa-facebook';
    return this.getSocialUrl(url,icon);
};
/**
 * Get instagram link icon
 * @returns {string}
 */
Hashtag.prototype.getInstagramUrl = function(){
    var url = 'https://www.instagram.com/explore/tags/' + this.getHashtag();
    var icon = 'fa fa-instagram';
    return this.getSocialUrl(url,icon);
};
/**
 * Get twitter link icon
 * @returns {string}
 */
Hashtag.prototype.getTwitterUrl = function(){
    var url = 'https://twitter.com/hashtag/' + this.getHashtag();
    var icon = 'fa fa-twitter';
    return this.getSocialUrl(url,icon);
};