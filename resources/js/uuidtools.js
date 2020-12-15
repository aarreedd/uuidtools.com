window.uuidv1 = function() {
	$.ajax({url: 'https://www.uuidtools.com/api/generate/v1'})
	 .done(function(data) {
	 	console.log(data)
	 	console.log('Try "decode(\''+data[0]+'\')"')
	 });
}
window.uuidv4 = function() {
	$.ajax({url: 'https://www.uuidtools.com/api/generate/v1'})
	 .done(function(data) {
	 	console.log(data)
	 	console.log('Try "decode(\''+data[0]+'\')"')
	 });
}
window.decode = function(uuid) {
	$.ajax({url: 'https://www.uuidtools.com/api/decode/' + uuid})
	 .done(function(data) {
	 	console.log(data)
		console.log('If you like this project, you can contribute here: https://github.com/aarreedd/uuidtools.com')
	 });
}

console.log('Welcome UUIDTools.com 🎉')
console.log('Try "uuidv1()" or "uuidv4()"')
