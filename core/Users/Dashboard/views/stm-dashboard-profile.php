<div class="stm-tab__pane" id="dashboard_profile">
  <form action="#" id="user_profile_form" method="post">
    <div class="stm-row">
      <div class="stm-col-lg-3">
        <div class="stm-image-profile-wrap">
          <div class="ez-media-uploader stm-profile-uploader">
            <div class="ezmu__drop-zone-section">
              <h2>Drop Here</h2>
            </div>
            <div class="ezmu__loading-section">
              <span class="ezmu__loading-icon">
                <span class="ezmu__loading-icon-img-bg"> </span>
              </span>
            </div>
            <div class="ezmu__media-picker-section ezmu--show">
              <div class="ezmu__media-picker-controls">
                <span class="ezmu__media-picker-icon-wrap-avater">
                  <span class="ezmu__icon ezmu-icon-avater"> </span>
                </span>
                <div class="ezmu__media-picker-buttons">
                  <div class="ezmu__upload-button-wrap">
                    <input
                      type="file"
                      id="ezmu__file-input"
                      class="ezmu__file-input"
                      accept=".jpg, .jpeg, .png, .gif"
                    />
                    <label
                      for="ezmu__file-input"
                      class="ezmu__btn ezmu__input-label"
                    >
                      Select
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="ezmu__preview-section">
              <div class="ezmu__thumbnail-area"></div>
              <div class="ezmu__media-picker-buttons">
                <div class="ezmu__upload-button-wrap">
                  <label
                    class="ezmu__btn ezmu__input-label ezmu__update-file-btn"
                    for="ezmu__file-input"
                  >
                    Select
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="stm-col-lg-9">
        <div class="stm-user-profile-edit">
          <div class="stm-card stm-user-profile-box">
            <div class="stm-card__header">
              <h4 class="stm-card__header--title">My Profile</h4>
            </div>
            <div class="stm-card__body">
              <div class="stm-user-info-wrap">
                <input type="hidden" name="ID" value="1" />
                <div class="stm-user-full-name">
                  <div class="stm-form-group">
                    <label for="full_name"> Display Name </label>
                    <input
                      class="stm-form-element"
                      type="text"
                      id="full_name"
                      name="user[full_name]"
                      value="admin"
                      placeholder="Enter your display name"
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="user_name"> User Name </label>
                    <input
                      class="stm-form-element"
                      id="user_name"
                      type="text"
                      disabled="disabled"
                      name="user[user_name]"
                      value="admin"
                    />
                    <span class="stm-input-extra-info">
                      (username can not be changed)
                    </span>
                  </div>
                </div>
                <div class="stm-user-first-name">
                  <div class="stm-form-group">
                    <label for="first_name"> First Name </label>
                    <input
                      class="stm-form-element"
                      id="first_name"
                      type="text"
                      name="user[first_name]"
                      value=""
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="last_name"> Last Name </label>
                    <input
                      class="stm-form-element"
                      id="last_name"
                      type="text"
                      name="user[last_name]"
                      value=""
                    />
                  </div>
                </div>
                <div class="stm-user-email">
                  <div class="stm-form-group">
                    <label for="req_email"> Email (required) </label>
                    <input
                      class="stm-form-element"
                      id="req_email"
                      type="text"
                      name="user[user_email]"
                      value="rjhabibms66@gmail.com"
                      required=""
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="phone"> Phone </label>
                    <input
                      class="stm-form-element"
                      type="tel"
                      id="phone"
                      name="user[phone]"
                      value=""
                      placeholder="Enter your phone number"
                    />
                  </div>
                </div>
                <div class="stm-user-site-url">
                  <div class="stm-form-group">
                    <label for="website"> Website </label>
                    <input
                      class="stm-form-element"
                      id="website"
                      type="text"
                      name="user[website]"
                      value="http://localhost/flippa"
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="address"> Address </label>
                    <input
                      class="stm-form-element"
                      id="address"
                      type="text"
                      name="user[address]"
                      value=""
                    />
                  </div>
                </div>
                <div class="stm-user-password">
                  <div class="stm-form-group">
                    <label for="new_pass"> New Password </label>
                    <input
                      id="new_pass"
                      class="stm-form-element"
                      type="password"
                      name="user[new_pass]"
                      placeholder="Enter a new password"
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="confirm_pass"> Confirm New Password </label>
                    <input
                      id="confirm_pass"
                      class="stm-form-element"
                      type="password"
                      name="user[confirm_pass]"
                      placeholder="Confirm your new password"
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="bio"> About Author </label>
                    <textarea
                      class="wp-editor-area stm-form-element"
                      style="height: 200px"
                      autocomplete="off"
                      cols="40"
                      name="user[bio]"
                      id="bio"
                    >
                    </textarea>
                  </div>
                </div>
                <div class="stm-user-socials">
                  <h4 class="stm-user-social-label">Social Profiles</h4>
                  <div class="stm-form-group">
                    <label for="facebook">
                      <span class="stm-social-icon">
                        <i
                          class="stm-icon-mask"
                          aria-hidden="true"
                          style="
                            --stm-icon: url(http://localhost/flippa/wp-content/plugins/stm/assets/icons/line-awesome/svgs/facebook-f.svg);
                          "
                        >
                        </i>
                      </span>
                      Facebook
                    </label>
                    <input
                      id="facebook"
                      class="stm-form-element"
                      type="url"
                      name="user[facebook]"
                      value=""
                      placeholder="Enter your facebook url"
                    />
                    <span class="stm-input-extra-info">
                      Leave it empty to hide
                    </span>
                  </div>
                  <div class="stm-form-group">
                    <label for="twitter">
                      <span class="stm-social-icon">
                        <i
                          class="stm-icon-mask"
                          aria-hidden="true"
                          style="
                            --stm-icon: url(http://localhost/flippa/wp-content/plugins/stm/assets/icons/line-awesome/svgs/twitter.svg);
                          "
                        >
                        </i>
                      </span>
                      Twitter
                    </label>
                    <input
                      id="twitter"
                      class="stm-form-element"
                      type="url"
                      name="user[twitter]"
                      value=""
                      placeholder="Enter your twitter url"
                    />
                    <span class="stm-input-extra-info">
                      Leave it empty to hide
                    </span>
                  </div>
                  <div class="stm-form-group">
                    <label for="linkedIn">
                      <span class="stm-social-icon">
                        <i
                          class="stm-icon-mask"
                          aria-hidden="true"
                          style="
                            --stm-icon: url(http://localhost/flippa/wp-content/plugins/stm/assets/icons/line-awesome/svgs/linkedin-in.svg);
                          "
                        >
                        </i>
                      </span>
                      LinkedIn
                    </label>
                    <input
                      id="linkedIn"
                      class="stm-form-element"
                      type="url"
                      name="user[linkedIn]"
                      value=""
                      placeholder="Enter linkedIn url"
                    />
                    <span class="stm-input-extra-info">
                      Leave it empty to hide
                    </span>
                  </div>
                  <div class="stm-form-group">
                    <label for="youtube">
                      <span class="stm-social-icon">
                        <i
                          class="stm-icon-mask"
                          aria-hidden="true"
                          style="
                            --stm-icon: url(http://localhost/flippa/wp-content/plugins/stm/assets/icons/line-awesome/svgs/youtube.svg);
                          "
                        >
                        </i>
                      </span>
                      Youtube
                    </label>
                    <input
                      id="youtube"
                      class="stm-form-element"
                      type="url"
                      name="user[youtube]"
                      value=""
                      placeholder="Enter youtube url"
                    />
                    <span class="stm-input-extra-info">
                      Leave it empty to hide
                    </span>
                  </div>
                </div>
                <button
                  type="submit"
                  class="stm-btn stm-btn-lg stm-btn-dark stm-btn-profile-save"
                  id="update_user_profile"
                >
                  Save Changes
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div id="stm-prifile-notice">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>