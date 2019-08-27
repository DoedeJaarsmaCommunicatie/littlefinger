import streekLinker from "../products/streekLinker";
import QtyBumper from "../products/QtyBumper";

export default {
    init() {
        new QtyBumper();
        try {
            streekLinker();
        } catch ( e ) {
            // Do Nothing
        }
    },
    finalize() {}
}
