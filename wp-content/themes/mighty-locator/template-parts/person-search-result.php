<div class="psfResult">
    <h2>Result Preview</h2>
    <div class="colGr">
        <div class="colGr__col colGr__col_6">
            <div class="mlCard mlCard_withPrefix">
                <div class="mlCard__prefix mlCard__prefix_success"><span id="preview-status"></span></div>
                <div class="mlCard__content">
                    <p class="mlCard__title">Search statistics</p>
                    <div class="mlCard__stats">
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber" id="preview-people-count"></p>
                            <p class="mlCard__statDescription">people found</p>
                        </div>
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber" id="preview-addresses-count"></p>
                            <p class="mlCard__statDescription">Addresses</p>
                        </div>
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber" id="preview-phones-count"></p>
                            <p class="mlCard__statDescription">Phone numbers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="colGr__col colGr__col_6">
            <div class="mlCard mlCard_withPrefix">
                <div class="mlCard__prefix mlCard__prefix_info"><span>Info</span></div>
                <div class="mlCard__content">
                    <p class="mlCard__title">Search information</p>
                    <div class="mlCard__stats">
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber" id="preview-searchPrice"></p>
                            <p class="mlCard__statDescription">Search Price</p>
                        </div>
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber" id="preview-search-type"></p>
                            <p class="mlCard__statDescription">Search type</p>
                        </div>
                        <div class="mlCard__stat">
                            <p class="mlCard__statNumber"><?php echo $member['membershipLevel']; ?></p>
                            <p class="mlCard__statDescription">Membership Level</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="button button_info psfResult__button" id="preview-redirect-link">See the result</a>
    <p class="psfResult__redirect">
        You are being redirected to full result in <span id="preview-redirect-timer"></span>
    </p>
</div>