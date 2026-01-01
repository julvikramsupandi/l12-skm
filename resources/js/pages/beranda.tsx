import { Button } from "@/components/ui/button";
import AppLayout from "@/layouts/app-layout";
import { Head, Link } from "@inertiajs/react";
import { CheckCircle2Icon, QuoteIcon } from "lucide-react";

export default function Beranda() {
    return (
        <AppLayout>
            <Head title="Beranda" />
            <section className="h-[calc(100vh-240px)] flex flex-col items-center justify-center">
                <h1 className="text-4xl font-extrabold mb-4">
                    Selamat Datang di Aplikasi Survei Kepuasan Masyarakat
                </h1>
                <p className="text-gray-500 mb-8 max-w-4xl mx-auto text-center">
                    Survei ini bertujuan meningkatkan kualitas layanan Provinsi Gorontalo dengan cara mengumpulkan data dan informasi yang akurat dan objekt tentang kepuasan masyarakat terhadap layanan Provinsi Gorontalo.
                </p>

                <Link href={route('survey')}>
                    <Button size="lg" className="mb-12">
                        <CheckCircle2Icon />
                        Mulai Survei
                    </Button>
                </Link>

            </section>
        </AppLayout>
    );
}
