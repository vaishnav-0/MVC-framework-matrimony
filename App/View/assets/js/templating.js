const compileToString = (template) => {
    const ast = parse(template);
    let fnStr = `""`;

    ast.map(t => {
        // checking to see if it is an interpolation
        if (t.startsWith("{{") && t.endsWith("}}")) {
            // append it to fnStr
            fnStr += `+data.${t.split(/{{|}}/).filter(Boolean)[0].trim()}`;
        } else {
            // append the string to the fnStr
            fnStr += `+"${t}"`;
        }
    });

    return fnStr;
}
var parse = (template) => {
    let result = /{{(.*?)}}/g.exec(template);
    let arr = [];
    let firstPos;

    while (result) {
        firstPos = result.index;
        if (firstPos !== 0) {
            arr.push(template.substring(0, firstPos));
            template = template.slice(firstPos);
        }

        arr.push(result[0]);
        template = template.slice(result[0].length);
        result = /{{(.*?)}}/g.exec(template);
    }

    if (template) arr.push(template);
    arr = arr.map((item) => {
        return item.replaceAll(`"`, `\\"`);
    });
    return arr;
}

export function compile(template) {
    return new Function("data", "return " + compileToString(template));
}

export function render(template, data) {
    return template(data);
}