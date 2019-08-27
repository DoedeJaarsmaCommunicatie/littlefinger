export default class QtyBumper {
    buttons: { less: HTMLButtonElement, add: HTMLButtonElement } = {
        less: document.querySelector<HTMLButtonElement>('.js-less-qty ')!,
        add: document.querySelector<HTMLButtonElement>('.js-add-qty ')!
    };

    input: HTMLInputElement|null = document.querySelector<HTMLInputElement>('#quantity');

    maximum: string|boolean;

    constructor() {
        if (!this.input) {
            throw new Error('Input not found');
        }

        this.maximum = this.input.max.length > 0 ? this.input.max : false;

        this.init();
    }

    public init() {
        this.addEvents();
    }

    addEvents() {
        this.buttons.add.addEventListener('click', () => this.increaseQty());

        this.buttons.less.addEventListener('click', () => this.decreaseQty());
    }

    increaseQty(): void {
        if (!this.maximum || this.input!.valueAsNumber < (this.maximum as unknown as number)) {
            this.input!.value = (this.input!.valueAsNumber + 1 ) as unknown as string;
        }
    }

    decreaseQty(): void {
        if (this.input!.valueAsNumber > 1) {
            this.input!.value = (this.input!.valueAsNumber - 1) as unknown as string;
        }
    }
}
