<?php

use Components\BlocksStaticLayouts\BlocksStaticLayoutsConfig;

global $post;
$Inputs = BlocksStaticLayoutsConfig::getAllBlocksInputs();
$LastKey = end(array_keys($Inputs));
foreach($Inputs as $key => $Input) {
    $BlocksOrder = get_option($Input);
    $BlocksOrder = json_encode($BlocksOrder, JSON_UNESCAPED_UNICODE);
?>

<meta charset="utf-8">
<h2 class="headline-for-special-blocks"><?= $key; ?></h2>
<div id="blocks-field-<?= $Input; ?>" class="blocks-field">

    <div class="select-row">

        <select v-model="BlockSelected">

            <optgroup v-for="(Group, Name) in BlocksAll" :label="Name">
                <option v-for="Option in Group" v-bind:key="Option.Id" v-bind:value="Option">
                    {{ Option.Title }}
                </option>
            </optgroup>

        </select>

        <button @click.prevent="addBlock(BlockSelected)" class="btn-add-block">
            <?php _e("Přidat blok", "PD_ADMIN_DOMAIN"); ?>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
            </svg>
        </button>

    </div>

    <input type="text" v-model="BlocksOrder" name="<?= BlocksStaticLayoutsConfig::FORM_PREFIX; ?>[<?= $Input; ?>]">

    <draggable class="blocks-field-list" tag="ul" v-bind="dragOptions" v-model="Blocks" @change="handleBlocksOrder">
        <li v-for="(Item, Index) in Blocks" :data-id="Item.Id">
            <strong v-html="Item.Title">
            </strong>
            <span v-if="Item.Type">
                ({{ Item.Type }})
            </span>

            <a v-if="Item.UrlEdit" :href="Item.UrlEdit" target="_blank">
                <?php _e("Upravit", "PD_ADMIN_DOMAIN"); ?>
                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" class="svg-inline--fa fa-edit fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="#000" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path>
                </svg>
            </a>

            <button class="btn-item-delete" @click.prevent="removeBlock(Index)">
                <?php _e("Odstranit", "PD_ADMIN_DOMAIN"); ?>
                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z"></path>
                </svg>
            </button>
        </li>
    </draggable>

</div>

<?php if($LastKey != $key) { ?>
    <hr />
<?php } ?>

<script>
    var blocksField = new Vue({
        el: "#blocks-field-<?= $Input; ?>",
        data: {
            BlockSelected: "",
            BlocksAll: [],
            Blocks: [],
            BlocksOrder: "",
            isContent: false,
        },
        computed: {
            dragOptions() {
                return {
                    animation: 300,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            }
        },
        methods: {
            addBlock(Block) {
                if (Block === "") {
                    return;
                }
                // this.$set(this.Blocks, Block);
                this.Blocks.push(Block);
                this.handleBlocksOrder();
            },
            removeBlock(Index) {
                this.$delete(this.Blocks, Index);
                this.handleBlocksOrder();
            },
            toggleEditor() {
                if (this.isContent) {
                    jQuery("#postdivrich").show();
                    // Wierd Content editor fix
                    var WindowCurrentY = jQuery(window).scrollTop();
                    jQuery(window).scrollTop(WindowCurrentY + 1);
                } else {
                    jQuery("#postdivrich").hide();
                }
            },
            getBlocksAll() {
                axios.get(BriloRestApiUrl.url + "blocks")
                    .then(response => {
                        this.BlocksAll = response.data;
                    })
                    .then(function() {
                        new Selectr("#blocks-field-<?= $Input; ?> select", {
                            width: 0
                        });
                    });
            },
            initBlocks() {
                var ItemsIds = <?= $BlocksOrder; ?>;
                ItemsIds = ItemsIds.toString();
                if (ItemsIds == []) {
                    return;
                }
                axios.get(BriloRestApiUrl.url + "blocks/" + ItemsIds)
                    .then(response => {
                        this.Blocks = response.data;
                        this.handleBlocksOrder();
                    });
            },
            handleBlocksOrder() {
                let BlocksOrder = [];
                this.isContent = false;
                for (const Item of this.Blocks) {
                    BlocksOrder.push(Item.Id);
                    if (Item.Id == "content") {
                        this.isContent = true;
                    }
                }
                this.BlocksOrder = BlocksOrder;
                this.toggleEditor();
            }

        },
        created() {
            this.getBlocksAll(), this.initBlocks(), this.toggleEditor()
        }
    });
</script>
<?php
}
?>