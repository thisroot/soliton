 google.load("visualization", "1", {packages:["corechart", "charteditor"]});
            $(function(){
                var derivers = $.pivotUtilities.derivers;
                var renderers = $.extend($.pivotUtilities.renderers, 
                    $.pivotUtilities.gchart_renderers);

                $.getJSON("https://nebesa.me/main/addons/pivottable-master/examples/mps.json", function(mps) {
                    $("#output").pivotUI(mps, {
                        renderers: renderers,
                        derivedAttributes: {
                            "Age Bin": derivers.bin("Age", 10),
                            "Gender Imbalance": function(mp) {
                                return mp["Gender"] == "Male" ? 1 : -1;
                            }
                        },
                        cols: ["Age Bin"], rows: ["Gender"],
                        rendererName: "Area Chart"
                    });
                });
             });


