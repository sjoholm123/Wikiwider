function nextElementSibling(el) {
    do { el = el.nextSibling } while ( el && el.nodeType !== 1 );
    return el;
}
  
  function ifocus(el) {
    nextElementSibling(el).className= 'username-label-after';
}
  
  function iblur(el) {
    if(!el.value.trim()) {
      nextElementSibling(el).className= 'username-label';
    }
}


function nextElementSibling(el) {
    do { el = el.nextSibling } while ( el && el.nodeType !== 1 );
    return el;
}
  
  function ifocus2(el) {
    nextElementSibling(el).className= 'password-label-after';
}
  
  function iblur2(el) {
    if(!el.value.trim()) {
      nextElementSibling(el).className= 'password-label';
    }
}