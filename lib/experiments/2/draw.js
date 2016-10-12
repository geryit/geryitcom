// Append the names of the enumerable properties of object o to the
// array a, and return a.  If a is omitted or null, create and return
// a new array
function copyPropertyNamesToArray(o, /* optional */ a) {
    if (!a) a = [];  // If undefined or null, use a blank array
    for(var property in o) a.push(property);
    return a;
}

copyPropertyNamesToArray(["a,b"])
