<?php // Template Name: Contact Us ?>

<?php get_header(); ?>

<div class="boxed-content">
    <div class="inner">
        <section>
            <?php include('components/components.php'); ?>
        </section>

        <aside>
            <form id="contact-form" data-form="contact" class="default-form" novalidate>
                <div class="fields">
                    <div class="field">
                        <label>First Name:*</label>
                        <input type="text" name="fname" required value="" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Last Name:*</label>
                        <input type="text" name="lname" required value="" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Email:*</label>
                        <input type="email" name="email" required value="" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Company:*</label>
                        <input type="text" name="company" required value="" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Title:</label>
                        <input type="text" name="title" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Phone Number:</label>
                        <input type="text" name="phone" />
                        <div class="inline-msg"></div>
                    </div>
<!--                    <div class="field">-->
<!--                        <label>Type of Request:*</label>
<!--                        <select required name="request">-->
<!--                            <option>Please select one</option>-->
<!--                            <option>Request 1</option>-->
<!--                        </select>-->
<!--                        <div class="inline-msg"></div>-->
<!--                    </div>-->
                    <div class="field">
                        <input type="submit" id="submit" value="Contact Us" class="btn" />
                    </div>
                </div>
                <div class="form-success">

                </div>
            </form>
        </aside>
    </div>
</div>

<?php get_footer(); ?>