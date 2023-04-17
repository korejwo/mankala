function obj2zlib(obj) {
    return String.fromCharCode.apply(null, pako.deflate(JSON.stringify(obj)));
}

function zlib2obj(string) {
    const strLen = string.length;
    const buf = new ArrayBuffer(strLen);
    const bufView = new Uint8Array(buf);

    for (let i= 0; i < strLen; i++) {
        bufView[i] = string.charCodeAt(i);
    }

    return JSON.parse(pako.inflate(buf, { to: 'string' }));
}
