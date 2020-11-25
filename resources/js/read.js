$('.read').on('click', function (e) {
    let word = this.parentElement.parentElement.getElementsByClassName('word')[0].value;
    var msg = new SpeechSynthesisUtterance(word);
    window.speechSynthesis.speak(msg);
});
