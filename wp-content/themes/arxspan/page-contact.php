<?php // Template Name: Contact Us ?>

<?php get_header(); ?>

<div class="boxed-content">
    <div class="inner">
        <section>
            <h1 class="title">Get in Touch with Us!</h1>
            <p>Please take a moment to complete the form below and we'll contact you promptly.</p>
            <ul>
                <li>Something will go here yadda yadda</li>
                <li>Something will go here yadda yadda</li>
                <li>Something will go here yadda yadda</li>
                <li>Something will go here yadda yadda</li>
            </ul>
        </section>
        <aside>
            <form id="contact-form" class="default-form" novalidate>
                <div class="fields">
                    <div class="field">
                        <label>First Name:*</label>
                        <input type="text" name="fname" required value="devon" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Last Name:*</label>
                        <input type="text" name="lname" required value="riley" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Email:*</label>
                        <input type="email" name="email" required value="dev@Knowncreative.co" />
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <label>Company:*</label>
                        <input type="text" name="company" required value="known" />
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
                    <div class="field">
<!--                        <label>Type of Request:*</label>-->
                        <select required name="request">
                            <option>Please select one</option>
                            <option>Request 1</option>
                        </select>
                        <div class="inline-msg"></div>
                    </div>
                    <div class="field">
                        <input type="submit" id="submit" value="Submit" class="btn" />
                    </div>
                </div>
                <div class="form-success">

                </div>
            </form>
        </aside>
    </div>
</div>

<?php get_footer(); ?>