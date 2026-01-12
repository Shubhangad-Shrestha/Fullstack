const movie = {
title: "The Shawshank Redemption",
year: 1994,
// This works fine
getInfo: function() {
return `${this.title} (${this.year})`
;
},
// This is broken - fix it!
delayedInfo: function() {
setTimeout(function() {
console.log(`${this.title} was released in ${this.year}`);
}, 1000);
}
};
movie.getInfo();
movie.delayedInfo()
