export default class QtyBumper {
    buttons: { less: NodeListOf<HTMLButtonElement>, add: NodeListOf<HTMLButtonElement> } = {
        less: document.querySelectorAll<HTMLButtonElement>('.js-less-qty ')!,
        add: document.querySelectorAll<HTMLButtonElement>('.js-add-qty ')!
    };

    constructor() {
        this.init();
    }

    public init(): void {
        // @ts-ignore
        for (let less of this.buttons.less) {
            new ButtonHandler(
                less,
                document.querySelector<HTMLInputElement>(less.dataset.target!)!,
                false,
                'less'
            )
        }

        // @ts-ignore
        for (let add of this.buttons.add) {
            const input = document.querySelector<HTMLInputElement>(add.dataset.target!)!;
            new ButtonHandler(
                add,
                input,
                input.max
            )
        }
    }
}

export class ButtonHandler {
    input: HTMLInputElement;
    button: HTMLButtonElement;
    maximum: string|boolean;

    constructor(
        button: HTMLButtonElement,
        input: HTMLInputElement,
        maximum: string|boolean = false,
        type: string = 'add')
    {
        this.input = input;
        this.button = button;
        this.maximum = maximum;

        this.addEvent(type);
    }

    addEvent(type: string) {
        if(type === 'add') {
            this.button.addEventListener('click', () => this.increaseQty());
        }

        if (type === 'less') {
            this.button.addEventListener('click', () => this.decreaseQty());
        }
    }

    increaseQty(): void {
        if (!this.maximum || this.input!.valueAsNumber < (this.maximum as any as number)) {
            this.input!.value = (this.input!.valueAsNumber + 1 ) as any as string;
        }
    }

    decreaseQty(): void {
        if (this.input!.valueAsNumber > 1) {
            this.input!.value = (this.input!.valueAsNumber - 1) as any as string;
        }
    }
}
