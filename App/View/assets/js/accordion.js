//pass accordion container to bind function, add accordion content inside accordion container, set data-target of accordion container to id of accordion content
//accordion container element contain these attributes
//data-target : id of accordion content
//data-index : order for navigation(not required to be in consecutive numeric order). To use nested navigation use this attribute in the form (grandparent-parent-child)
//data-title : heading for accordion 
//data-isdisabled : for disabling accordion
//accordion container sample <div class="accordion" data-index="2-1" data-target="p_details" data-title="Personal details" data-isdisabled="true">
import { render,compile,renderToDOM } from './templating.js';
let Temp = `<button type="button" class="accordionHeadbtn" data-index="{{index}}" data-target="{{target}}"><div class="accordionHeading"><div class=accordionTitle> {{title}}</div></div><div class="accordionHeadcaret"><span class="fa fa-caret-right faicon"></span></div></button>`,
    activehead = -1,
    index = new Object(),
    currIndex = new Object(),
    c = compile(Temp),
    settings = { keys: { 'up': 'ArrowUp', 'down': 'ArrowDown', 'inside': 'ArrowRight', 'outside': 'ArrowLeft' }, open: true };
currIndex.branch = []

index = { 0: { 'elm': null } };

// Options for the observer (which mutations to observe)
const mutConfig = { attributes: true, childList: true, subtree: true };



function accordionctrl(e) {
    if(e.currentTarget.parentElement.dataset.isdisabled){
        return;
    }
    let currPress = e.currentTarget;
    let heading = currPress.querySelector(".accordionHeading");
    let w = currPress.querySelector(".accordionTitle").offsetWidth;
    heading.classList.toggle("activeformhead");
    let iconspan = currPress.querySelector(".faicon");
    let target = document.getElementById(currPress.dataset.target);
    if (target.clientHeight) {
        heading.style.width = 100 + "%";
        target.style.height = 0;
        iconspan.classList.replace("fa-caret-down", "fa-caret-right");

    } else {
        heading.style.width = w + "px";
        setToScrollHeight(target);
        iconspan.classList.replace("fa-caret-right", "fa-caret-down");

    }

}

function setToScrollHeight(elm) {
    elm.style.height = elm.scrollHeight + "px";

}
const mutationCallback = function(mutationsList, observer) {
    // Use traditional 'for loops' for IE 11
    for (const mutation of mutationsList) {
        if (mutation.type === 'childList') {
            if (observer.target.style.height !== '') {
                setToScrollHeight(observer.target);
            }
        } else if (mutation.type === 'attributes') {
            //console.log('The ' + mutation.attributeName + ' attribute was modified.');
        }
    }
};


function addAccordionEvent(elm) {
    document.addEventListener("keydown", e => {
        switch (e.key) {
            case settings.keys.down:
                if (activehead === -1 || activehead === currIndex.length - 1) {
                    elm[currIndex.index[0]].focus();
                } else {
                    elm[currIndex.index[activehead + 1]].focus();
                }
                break;
            case settings.keys.up:
                if (activehead === -1 || activehead === 0) {
                    elm[currIndex.index[currIndex.length - 1]].focus();
                } else {
                    elm[currIndex.index[activehead - 1]].focus();

                }
                break;
            case settings.keys.inside:
                if(elm[currIndex.index[activehead]].parentElement.dataset.isdisabled){
                    break;
                }
                if (!elm[currIndex.index[activehead]].querySelector('.activeformhead')) {
                    elm[currIndex.index[activehead]].click();

                }
                if (currIndex.sub[activehead].hasOwnProperty('sub')) {
                    currIndex.branch.push(activehead);
                    setCurrIndex();
                    elm[currIndex.index[0]].focus();
                }
                break;
            case settings.keys.outside:
                if (currIndex.branch.length > 1) {
                    let lastBranch = currIndex.branch[currIndex.branch.length - 1];
                    currIndex.branch.pop();
                    setCurrIndex();
                    elm[currIndex.index[lastBranch]].focus();
                }
        }


    });
    elm.forEach(element => {
        element.addEventListener("click", accordionctrl);

    });
    elm.forEach(element => {
        element.addEventListener("focus", e => {
            activehead = Array.prototype.indexOf.call(currIndex.index, Array.prototype.indexOf.call(elm, e.target));
        });
    });
    elm.forEach(element => {
        element.addEventListener("blur", e => {
            activehead = -1;
        });
    });
}

function setCurrIndex() {
    currIndex.index = []
    let ar = currIndex.branch;
    let lastIndex = ar.reduce((a, c) => {
        return a[c].sub;
    }, index);
    currIndex.sub = lastIndex;
    Object.keys(lastIndex).forEach((k) => {
        currIndex.index[k] = lastIndex[k].elm;
    });
    currIndex.length = currIndex.index.length;

}

function setIndex(elm) {
    let indx, indArr, keys, ind;
    elm.forEach(element => {
        indx = element.dataset.index;
        indArr = indx.split('-');
        indArr = indArr.map(a => {
            return parseInt(a);
        });
        indArr.reduce((a, c) => {
            if (!a.hasOwnProperty('sub')) {
                a['sub'] = {};
            }
            if (!a['sub'].hasOwnProperty(c)) {
                let obj = new Object()
                obj['elm'] = Array.prototype.indexOf.call(elm, element)
                a['sub'][c] = obj;
                return;
            }
            return a['sub'][c];
        }, index[0]);
    });
    turntoNumeric(index);
}

function turntoNumeric(obj) {
    let ar = [];
    for (var i in obj) {
        if (obj.hasOwnProperty(i)) {
            if (obj[i].hasOwnProperty('sub')) {
                turntoNumeric(obj[i]['sub']);
            }
            ar.push(i);
        }

    }
    ar.sort();
    ar.forEach((val, indx) => {
        obj[indx] = obj[val];
        if (indx !== parseInt(val))
            delete obj[val];
    });


}
export function bind(container) {
    let target = container.dataset.target,
        targetElm = document.getElementById(target),
        title = container.dataset.title,
        indx = container.dataset.index,
        data = { 'target': target, 'title': title, 'index': indx },
        template = new DOMParser().parseFromString(render(c, data), "text/html"),
        a = template.body.children;
    for (let i = 0; i < a.length; i++) {
        container.insertBefore(a[i].cloneNode(true), container.firstChild);
    }
    let observer = new MutationObserver(mutationCallback);
    observer.target = targetElm;
    // Start observing the target node for configured mutations
    observer.observe(targetElm, mutConfig);
}

export function init() {
    let elm = document.querySelectorAll(".accordionHeadbtn");
    setIndex(elm);
    addAccordionEvent(elm);
    currIndex.branch.push(0);
    setCurrIndex();
    if (settings.open === true) {
        setTimeout(() => {
            elm[0].click();
        }, 100);
    }
}