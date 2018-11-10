
// Reworked to be used in both frames and tabs u.i.. sjp 12/01/17
// Removed legacy dialog support. sjp 12/16/17
// All window.close() should be removed from scripts and replaced with dlgclose() where possible
// usually anywhere dlgopen() is used. Also, top.dlgclose and parent.dlgclose() is available.
//
if (!opener) {
    opener = top.get_opener(window.name);
}

window.close =
    function (call, args) {
        var frameName = window.name;
        var wframe = opener;
        if (!top.tab_mode) {
            for (; wframe.name !== 'RTop' && wframe.name !== 'RBot'; wframe = wframe.parent) {
                if (wframe.parent === wframe) {
                    wframe = window;
                }
            }
            for (let i = 0; wframe.document.body.localName !== 'body' && i < 4; wframe = wframe[i++]) {
                if (i === 3) {
                    console.log("Opener: unable to find modal's frame");
                    return false;
                }
            }
            dialogModal = wframe.$('div#' + frameName);
        } else {
            var dialogModal = top.$('div#' + frameName);
            wframe = top;
        }

        var removeFrame = dialogModal.find("iframe[name='" + frameName + "']");
        if (removeFrame.length > 0) {
            removeFrame.remove();
        }

        if (dialogModal.length > 0) {
            if(call){
                wframe.setCallBack(call, args);
            }
            dialogModal.modal('hide');
        }

    };

var dlgclose =
    function (call, args) {
        var frameName = window.name;
        var wframe = opener;
        if (!top.tab_mode) {
            for (; wframe.name !== 'RTop' && wframe.name !== 'RBot'; wframe = wframe.parent) {
                if (wframe.parent === wframe) {
                    wframe = window;
                }
            }
            for (let i = 0; wframe.document.body.localName !== 'body' && i < 4; wframe = wframe[i++]) {
                if (i === 3) {
                    console.log("Opener: unable to find modal's frame");
                    return false;
                }
            }
            dialogModal = wframe.$('div#' + frameName);
        } else {
            var dialogModal = top.$('div#' + frameName);
            wframe = top;
        }

        var removeFrame = dialogModal.find("iframe[name='" + frameName + "']");
        if (removeFrame.length > 0) {
            removeFrame.remove();
        }

        if (dialogModal.length > 0) {
            if(call){
                wframe.setCallBack(call, args);
            }
            dialogModal.modal('hide');
        }

    };
