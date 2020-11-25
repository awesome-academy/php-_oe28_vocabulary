$('.speech').on('click', function (e) {
    e.preventDefault();
    let word = this.parentElement.parentElement.getElementsByClassName('word')[0].innerHTML;
    var msg = new SpeechSynthesisUtterance(word);
    window.speechSynthesis.speak(msg);
});
