import { render } from './templating.js';
import { compile } from './templating.js';
const validationTemplate = `<span class="fa fa-exclamation-circle errIcon"></span><div class="errMsg hideMsg">{{ error }}</div>`;
let hideTimeout;
var c = compile(validationTemplate);

function getValidRule(rule) {
    switch (rule) {
        case "email":
            return {
                title: "email",
                stop: true,
                required: true,
                email: true
            }
            break;
        case "required":
            return{
                title: "required",
                stop: true,
                required: true,
            }


    }
}

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
export function validate(feild, errnode) { //input feild obj, error displaying 

    let valRes = approve.value(feild.value, getValidRule(feild.dataset.validate));
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
            let elm = new DOMParser().parseFromString(render(c, data), "text/html");
            let a = elm.body.children;
            for (let i = 0; i < a.length; i++) {
                errnode.append(a[i].cloneNode(true));

            }
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
        feild.classList.add('err-input');
    } else {
        if (errnode.querySelector(".errMsg")) {
            errnode.textContent = '';
            feild.classList.remove('err-input');
            feild.removeAttribute('title');
        }
    }

}