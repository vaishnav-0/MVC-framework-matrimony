//pass accordion container to bind function, add accordion content inside accordion container, set data-target of accordion container to id of accordion content
//data-target - id of accordion content
//data-title - heading for accordion 
//accordion container sample <div class="accordion" data-target="p_details" data-title="Personal details">
import { render } from './templating.js';
import { compile } from './templating.js';
let Temp = `<button class="accordionHeadbtn" data-target="{{target}}"><div class="accordionHeading"><div class=accordionTitle> {{title}}</div></div><div class="accordionHeadcaret"><span class="fa fa-caret-right faicon"></span></div></button>`,
    activehead = -1,
    c = compile(Temp);


function accordionctrl(e) {
    let currPress = e.currentTarget;
    let heading = currPress.querySelector(".accordionHeading");
    heading.classList.toggle("activeAccordionHead");
    let iconspan = currPress.querySelector(".faicon");
    let target = document.getElementById(currPress.dataset.target);
    if (target.clientHeight) {
        target.style.height = 0;
        iconspan.classList.replace("fa-caret-down", "fa-caret-right");

    } else {
        target.style.height = target.scrollHeight + "px";
        iconspan.classList.replace("fa-caret-right", "fa-caret-down");

    }

}



function addAccordionEvent() {
    let accButton = document.querySelectorAll(".accordionHeadbtn");
    accButton.forEach(element => {
        element.addEventListener("click", accordionctrl);

    });
    accButton.forEach(element => {
        element.addEventListener("focus", e => {
            activehead = Array.prototype.indexOf.call(accButton, e.target);
        });
    });
    accButton.forEach(element => {
        element.addEventListener("blur", e => {
            activehead = -1;
        });
    });
}

function addkeydownEvent() {
    document.addEventListener("keydown", e => {
        switch (e.key) {
            case "ArrowDown":
                if (activehead === -1 || activehead === accButton.length - 1) {
                    accButton[0].focus();
                } else {
                    accButton[activehead + 1].focus();
                }
                break;
            case "ArrowUp":
                if (activehead === -1 || activehead === 0) {
                    accButton[accButton.length - 1].focus();
                } else {
                    accButton[activehead - 1].focus();

                }
                break;
        }


    });
}
export function bind(container) {
    let target = container.dataset.target,
        title = container.dataset.title,
        data = { 'target': target, 'title': title },
        template = new DOMParser().parseFromString(render(c, data), "text/html"),
        a = template.body.children;
    addkeydownEvent();
    for (let i = 0; i < a.length; i++) {
        container.insertBefore(a[i].cloneNode(true), container.firstChild);
    }
}

export function init() {
    addAccordionEvent();
    document.querySelector(".accordionHeadbtn").click();
}