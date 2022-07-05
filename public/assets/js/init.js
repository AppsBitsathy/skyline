$(document).on('ready', function() {
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.tabs').tabs();
    $('select').formSelect();
    $('.tooltipped').tooltip();
    $('.modal').modal();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        showClearBtn: true,
        showDaysInNextAndPreviousMonths: true,
        autoClose: true
    });
});

$('button').on('click', function() {
    $('#progress').removeClass('hide');
});

function pointAtX(a, b, x) {
    var slope = (b[1] - a[1]) / (b[0] - a[0]);
    var y = a[1] + (x - a[0]) * slope;
    return [x, y];
}

function pointAtY(a, b, y) {
    var slope = (b[1] - a[1]) / (b[0] - a[0]);
    var x = a[1] + (y - a[0]) * slope;
    return [x, y];
}

function findLineIntercepts(t1, t2) {
    try {
        const lineIntercepts = (() => {
            const Point = (x, y) => ({
                x,
                y
            });
            const Line = (p1, p2) => ({
                p1,
                p2
            });
            const Vector = line => Point(line.p2.x - line.p1.x, line.p2.y - line.p1.y);

            function interceptSegs(line1, line2) {
                const a = Vector(line1),
                    b = Vector(line2);
                const c = a.x * b.y - a.y * b.x;
                if (c) {
                    const e = Point(line1.p1.x - line2.p1.x, line1.p1.y - line2.p1.y);
                    const u = (a.x * e.y - a.y * e.x) / c;
                    if (u >= 0 && u <= 1) {
                        const u = (b.x * e.y - b.y * e.x) / c;
                        if (u >= 0 && u <= 1) {
                            return Point(line1.p1.x + a.x * u, line1.p1.y + a.y * u);
                        }
                    }
                }
            }
            const PointFromTable = (t, idx) => Point(t.x[idx], t.y[idx]);
            const LineFromTable = (t, idx) => Line(PointFromTable(t, idx++), PointFromTable(t, idx));
            return function(table1, table2) {
                const results = [];
                var i = 0,
                    j;
                while (i < table1.x.length - 1) {

                    const line1 = LineFromTable(table1, i);
                    j = 0;
                    while (j < table2.x.length - 1) {
                        const line2 = LineFromTable(table2, j);
                        const point = interceptSegs(line1, line2);
                        if (point) {
                            results.push({
                                description: `'${table1.name}' line seg index ${i}-${i + 1} intercepts '${table2.name}' line seg index ${j} - ${j + 1}`,

                                // The description (line above) can be replaced 
                                // with relevant data as follows
                                /*  remove this line to include additional info per intercept
                                                        tableName1: table1.name,
                                                        tableName2: table2.name,
                                                        table_1_PointStartIdx: i,
                                                        table_1_PointEndIdx: i + 1,   
                                                        table_2_PointStartIdx: j,
                                                        table_2_PointEndIdx: j + 1,   
                                and remove this line */

                                x: point.x,
                                y: point.y,
                            });
                        }
                        j++;
                    }
                    i++;
                }
                if (results.length) {
                    // console.log("Found " + results.length + " intercepts for '" + table1.name + "' and '" + table2.name + "'");
                    // console.log(results);
                    return results;
                }
                // console.log("No intercept found for  '" + table1.name + "' and '" + table2.name + "'");
            }
        })();

        const results = lineIntercepts(t1, t2);

        if (results) {

            for (const intercept of results) {
                const x = intercept.x; // get x
                const y = intercept.y; // get y
            }

        }

        return results[0];

    } catch (error) {
        console.log(error);
        console.log(t1.name);
        console.log(t2.name);
        M.toast({html:'Error : '+t1.name + ' & ' + t2.name +' Line Interception not found!', classes: 'rounded'});
        // return [{
        //     x: 0,
        //     y: 0
        // }];
    }

}

let toggle = 0;
$('#hide_show').click(function() {
    if (toggle == 0) {
        $('#chartDiv').addClass('m11 l11');
        Plotly.relayout('myDiv', {});
        toggle = 1;
    } else {
        $('#chartDiv').removeClass('m11 l11');
        Plotly.relayout('myDiv', {});
        toggle = 0;
    }
});

$('#chartType').change(function(e) {
    let selectedType = e.target.value;

    if (selectedType == 'Bar') {
        $('#barCharts').removeClass('hide');
        $('#pieCharts').addClass('hide');
    } else {
        $('#barCharts').addClass('hide');
        $('#pieCharts').removeClass('hide');
    }
});

$('#graphPrintBtn').on('click', function() {
    $('body').css('visibility', 'hidden');
    $('#chartDiv').css('visibility', 'visible');
    $('#chartDiv').addClass('m12 l12');
    Plotly.relayout('myDiv', {});
    $('#chartDiv').css({ 'position': 'absolute', 'left': 0, 'top': 0, 'size': 'landscape' });
    print();
    $('body').css('visibility', 'visible');
    $('#chartDiv').css('visibility', 'visible');
    $('#chartDiv').removeClass('m12 l12');
    Plotly.relayout('myDiv', {});
    $('#chartDiv').css({ 'position': '', 'left': '', 'top': '' });
});

$('#btnAddPrint').on('click', function() {
    $('body').css('visibility', 'hidden');
    $('#chartDiv').css('visibility', 'visible');
    $('#chartDiv').addClass('m12 l12');
    Plotly.relayout('myDiv', {});
    $('#chartDiv').css({ 'position': 'absolute', 'left': 0, 'top': 0, 'size': 'landscape' });
    print();
    $('body').css('visibility', 'visible');
    $('#chartDiv').css('visibility', 'visible');
    $('#chartDiv').removeClass('m12 l12');
    Plotly.relayout('myDiv', {});
    $('#chartDiv').css({ 'position': '', 'left': '', 'top': '' });
    $('#progress').removeClass('hide');
});