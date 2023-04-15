const canvas = new fabric.Canvas('game');
const defaultValues = {
    fill: 'transparent',
    radius: 60,
    strokeWidth: 1,
    stroke: '#000',
    startAngle: 90,
    endAngle: 270,
    selectable: false,
    hoverCursor: 'default',
    moveCursor: 'default',
};
const colors = ['red', 'green', 'blue', 'orange', 'yellow', 'purple'];

for (let i = 0; i < 3; i++) {
    canvas.add(
        new fabric.Line(
            [160, 30 + i * 120, 610, 30 + i * 120],
            Object.assign(
                defaultValues,
                {
                    absolutePositioned: true,
                }
            )
        )
    );
}

for (let i = 0; i < 2; i++) {
    for (let j = 0; j < 2; j++) {
        canvas.add(
            new fabric.Circle(
                Object.assign(
                    defaultValues,
                    {
                        startAngle: 90 + j * 180,
                        endAngle: 270 + j * 180,
                        left: 100 + j * 450,
                        top: 30 + i * 120,
                    }
                )
            )
        );
    }
}

for (let i = 0; i < 6; i++) {
    for (let j = 0; j < 2; j++) {
        for (let k = 0; k < 2; k++) {
            canvas.add(
                new fabric.Circle(
                    Object.assign(
                        defaultValues,
                        {
                            radius: 30,
                            startAngle: 90 + k * 180,
                            endAngle: 270 + k * 180,
                            left: 130 + i * 90,
                            top: 60 + j * 120,
                        }
                    )
                )
            );
        }
    }
}

let rocks = [];

for (let i = 0; i < 6; i++) {
    for (let j = 0; j < 2; j++) {
        for (let k = 0; k < 4; k++) {
            const rock = new fabric.Circle(
                Object.assign(
                    defaultValues,
                    {
                        fill: colors[Math.floor(Math.random() * colors.length)],
                        radius: 8,
                        startAngle: 0,
                        endAngle: 360,
                        left: 130 + i * 90,
                        top: 60 + j * 120,
                        selectable: true,
                        hoverCursor: 'pointer',
                        moveCursor: 'pointer',
                        hasControls: false,
                    }
                )
            );
            rock.on('moving', function() {
                if (!connected || !socket) {
                    return;
                }

                socket.emit('moving', 1);
            });
            canvas.add(rock);
            rocks.push(rock);
        }
    }
}
