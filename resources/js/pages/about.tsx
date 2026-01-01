import { Button } from "@/components/ui/button"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { motion } from "framer-motion"
import { Link, Head } from "@inertiajs/react"
import AppLayout from "@/layouts/app-layout"

export default function About() {
    return (
        <AppLayout>
            <Head title="Tentang Kami" />
            <motion.div
                className="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-white to-gray-50 px-4"
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                transition={{ duration: 0.6 }}
            >
                <Card className="max-w-2xl w-full shadow-xl rounded-2xl">
                    <CardHeader>
                        <CardTitle className="text-3xl font-bold text-center text-gray-800">
                            Tentang Kami
                        </CardTitle>
                    </CardHeader>
                    <CardContent className="space-y-4 text-gray-600 leading-relaxed">
                        <p>
                            Aplikasi ini dibuat menggunakan <b>Laravel 12</b> dan <b>React (Inertia + shadcn/ui)</b>
                            untuk memberikan pengalaman pengguna yang cepat, modern, dan dinamis.
                        </p>
                        <p>
                            Halaman ini di-render menggunakan Inertia, sehingga tidak terjadi reload penuh ketika berpindah halaman.
                        </p>
                        <div className="flex justify-center">
                            <Link href="/" className="mt-4">
                                <Button>⬅️ Kembali ke Beranda</Button>
                            </Link>
                        </div>
                    </CardContent>
                </Card>
            </motion.div>
        </AppLayout>
    )
}
