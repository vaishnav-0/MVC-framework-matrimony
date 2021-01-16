import { render,compile,renderToDOM } from './templating.js';
const validationTemplate = `<span class="fa fa-exclamation-circle errIcon"></span><div class="errMsg hideMsg">{{ error }}</div>`;
let hideTimeout;
var c = compile(validationTemplate),init=false;
const validForm = new CustomEvent('validForm', {
    bubbles: true,
    detail: { }
  });


function fade(node) {
    node.classList.add("errmsg-fadeout");
    hideTimeout = window.setTimeout(() => {
        node.classList.add("hideMsg");
    }, 2000); // see opacity transition
}

function show(node) {
    node.classList.remove("errmsg-fadeout");
    node.classList.remove("hideMsg");
}

function showAndFade(node) {
    show(node.querySelector(".errMsg"));
    window.setTimeout(() => {
        fade(node.querySelector(".errMsg"));
    }, 2000);
}

function submitCheck(e){
    let check = true;
    e.preventDefault();
    e.target.querySelectorAll('input,textarea,select').forEach(elm =>{
        elm.focus();
        elm.blur();
        if(check){
            if(elm.dataset.validfail){
                check = false
            }
        }  
    });
    console.log(check);
    if(check){
        e.target.dispatchEvent(validForm);
    }
}
function validate(feild, errnode, rule) { //input feild obj, error displaying 

    let valRes = approve.value(feild.value, rule);
    if (valRes.errors.length !== 0) {
        let data = {
            "error": ""
        };
        let errmsg = errnode.querySelector(".errMsg");
        if (errmsg) {
            errmsg.textContent = '';
            valRes.each(function(error) {
                errmsg.textContent += error;
            });
            showAndFade(errnode);
        } else {
            
            valRes.each(function(error) {
                data.error += error;
            });
            renderToDOM(render(c, data),errnode);
            errnode.querySelector('.errIcon').addEventListener('mouseover', (e) => {
                window.clearTimeout(hideTimeout);
                show(e.target.parentElement.querySelector('.errMsg'));
            });
            errnode.querySelector('.errIcon').addEventListener('mouseout', (e) => {
                fade(e.target.parentElement.querySelector('.errMsg'));
            });
            showAndFade(errnode);

        }
        feild.title = data.error;
        feild.setAttribute('data-validfail','true');
        feild.classList.add('err-input');
    } else {
        if (errnode.querySelector(".errMsg")) {
            errnode.textContent = '';
            feild.classList.remove('err-input');
            feild.removeAttribute('title');
            feild.removeAttribute('data-validfail');

        }
    }
    
    

}
export function bind(node,errTarget, rule){
    if(!init){
        init = true;
        document.addEventListener('submit', submitCheck);
        document.querySelectorAll('form').forEach(elm =>{
            elm.setAttribute('novalidate','');
        })
        
    }
    if(Object.getPrototypeOf(Object.getPrototypeOf(node)).constructor.name === 'HTMLElement')
    {
        node.addEventListener("focusout", (e) => {
            validate(e.target, errTarget,rule);
        });
    }

}