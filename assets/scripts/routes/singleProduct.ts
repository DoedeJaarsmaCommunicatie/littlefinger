import QtyBumper from "./products/QtyBumper";
import { domeinLinker, druifLinker, streekLinker } from "./products/Linker";

export default {
    init() {
        new QtyBumper();
        try {
            streekLinker();
            domeinLinker();
            druifLinker();
        } catch ( e ) {
            console.warn(e.message);
        }
    },
    finalize() {}
}
